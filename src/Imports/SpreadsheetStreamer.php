<?php

namespace EduMicro\DaisyLw4\Imports;

/**
 * Fast streaming reader for xlsx and csv files.
 *
 * Unlike PhpSpreadsheet (which parses the entire XML even with a ReadFilter),
 * this class stops reading the file as soon as the requested rows are collected.
 * For xlsx it uses PHP's built-in zip:// stream handler + XMLReader.
 * For csv it uses fgetcsv with direct file seeking.
 *
 * Rows are 0-indexed: row 0 is the header row.
 *
 * Supported formats: xlsx, csv.
 * Falls back gracefully: returns [] for unsupported formats (e.g. xls).
 *
 * Note on shared strings: xlsx stores string cell values in xl/sharedStrings.xml.
 * This file is loaded in full before streaming the sheet — it is typically compact
 * (column headers + a few unique values) and fast to parse. Files with hundreds of
 * thousands of unique string values are unusual in practice.
 */
class SpreadsheetStreamer
{
    /**
     * Return headers + up to $rows data rows from the file.
     *
     * @return array{headers: list<string>, rows: list<list<mixed>>, total: int|null}
     */
    public static function preview(string $path, int $rows = 5): array
    {
        $all = self::rows($path, offset: 0, limit: $rows + 1);

        return [
            'headers' => array_map('strval', array_values($all[0] ?? [])),
            'rows'    => array_slice($all, 1),
            'total'   => self::xlsxRowCount($path),
        ];
    }

    /**
     * Read rows from the file starting at $offset, up to $limit rows.
     *
     * Row 0 is the header row. Offset and limit count physical <row>
     * elements in the file, so offset=1 skips the header row.
     *
     * @return list<list<mixed>>
     */
    public static function rows(string $path, int $offset = 0, int $limit = PHP_INT_MAX): array
    {
        return match (strtolower(pathinfo($path, PATHINFO_EXTENSION))) {
            'xlsx'  => self::xlsxRows($path, $offset, $limit),
            'csv'   => self::csvRows($path, $offset, $limit),
            default => [],
        };
    }

    // ── xlsx ──────────────────────────────────────────────────────────────────

    private static function xlsxRows(string $path, int $offset, int $limit): array
    {
        $real = realpath($path) ?: $path;

        $sharedStrings = self::xlsxSharedStrings($real);

        $reader = new \XMLReader();
        if (!$reader->open('zip://' . $real . '#xl/worksheets/sheet1.xml')) {
            return [];
        }

        $rows        = [];
        $rowIdx      = -1;
        $currentRow  = [];
        $maxColIdx   = -1;
        $cellRef     = '';
        $cellType    = '';
        $inValue     = false;
        $inInlineStr = false;
        $stop        = false;

        while (!$stop && $reader->read()) {
            switch ($reader->nodeType) {

                case \XMLReader::ELEMENT:
                    switch ($reader->localName) {
                        case 'row':
                            $rowIdx++;
                            $currentRow  = [];
                            $maxColIdx   = -1;
                            if ($rowIdx >= $offset + $limit) {
                                $stop = true;
                            }
                            break;

                        case 'c':
                            $cellRef     = $reader->getAttribute('r') ?? '';
                            $cellType    = $reader->getAttribute('t') ?? '';
                            $inValue     = false;
                            $inInlineStr = false;
                            break;

                        case 'v':
                            if ($cellType !== 'inlineStr') {
                                $inValue = true;
                            }
                            break;

                        case 't':
                            // Inside <is> (inlineStr) or sharedStrings
                            if ($cellType === 'inlineStr') {
                                $inInlineStr = true;
                            }
                            break;
                    }
                    break;

                case \XMLReader::TEXT:
                case \XMLReader::CDATA:
                    if (!$stop && $rowIdx >= $offset) {
                        $colIdx = self::colRefToIndex($cellRef);

                        if ($inValue) {
                            $raw = $reader->value;
                            $currentRow[$colIdx] = $cellType === 's'
                                ? ($sharedStrings[(int) $raw] ?? '')
                                : $raw;
                            $maxColIdx = max($maxColIdx, $colIdx);
                        } elseif ($inInlineStr) {
                            $colIdx = self::colRefToIndex($cellRef);
                            $currentRow[$colIdx] = ($currentRow[$colIdx] ?? '') . $reader->value;
                            $maxColIdx = max($maxColIdx, $colIdx);
                        }
                    }
                    break;

                case \XMLReader::END_ELEMENT:
                    switch ($reader->localName) {
                        case 'row':
                            if (!$stop && $rowIdx >= $offset) {
                                $dense = [];
                                for ($i = 0; $i <= $maxColIdx; $i++) {
                                    $dense[] = $currentRow[$i] ?? null;
                                }
                                $rows[] = $dense;
                            }
                            break;

                        case 'v':
                            $inValue = false;
                            break;

                        case 't':
                            $inInlineStr = false;
                            break;
                    }
                    break;
            }
        }

        $reader->close();
        return $rows;
    }

    /**
     * Load xl/sharedStrings.xml fully into an indexed array.
     * Each <si> element maps to one entry; multiple <t> children are concatenated.
     */
    private static function xlsxSharedStrings(string $realPath): array
    {
        $reader = new \XMLReader();
        if (!@$reader->open('zip://' . $realPath . '#xl/sharedStrings.xml')) {
            return [];
        }

        $strings = [];
        $current = '';
        $inT     = false;

        while ($reader->read()) {
            switch ($reader->nodeType) {
                case \XMLReader::ELEMENT:
                    if ($reader->localName === 'si') {
                        $current = '';
                    } elseif ($reader->localName === 't') {
                        $inT = true;
                    }
                    break;

                case \XMLReader::TEXT:
                case \XMLReader::CDATA:
                    if ($inT) {
                        $current .= $reader->value;
                    }
                    break;

                case \XMLReader::END_ELEMENT:
                    if ($reader->localName === 't') {
                        $inT = false;
                    } elseif ($reader->localName === 'si') {
                        $strings[] = $current;
                    }
                    break;
            }
        }

        $reader->close();
        return $strings;
    }

    /**
     * Read the total data-row count from the <dimension> element.
     * Stops reading before <sheetData> so it is very fast.
     * Returns null if the dimension element is absent.
     */
    private static function xlsxRowCount(string $path): ?int
    {
        $real = realpath($path) ?: $path;
        if (!str_ends_with(strtolower($real), '.xlsx')) {
            return null;
        }

        $reader = new \XMLReader();
        if (!$reader->open('zip://' . $real . '#xl/worksheets/sheet1.xml')) {
            return null;
        }

        $count = null;
        while ($reader->read()) {
            if ($reader->nodeType !== \XMLReader::ELEMENT) {
                continue;
            }
            if ($reader->localName === 'dimension') {
                $ref = $reader->getAttribute('ref') ?? '';
                if (preg_match('/:\D+(\d+)$/', $ref, $m)) {
                    $count = max(0, (int) $m[1] - 1);
                }
                break;
            }
            if ($reader->localName === 'sheetData') {
                break;
            }
        }

        $reader->close();
        return $count;
    }

    /**
     * Convert a cell reference like "AB12" to a 0-based column index.
     * "A1" → 0, "B5" → 1, "Z3" → 25, "AA1" → 26, etc.
     */
    private static function colRefToIndex(string $cellRef): int
    {
        preg_match('/^([A-Z]+)/i', $cellRef, $m);
        $col   = strtoupper($m[1] ?? 'A');
        $index = 0;
        for ($i = 0, $len = strlen($col); $i < $len; $i++) {
            $index = $index * 26 + (ord($col[$i]) - 64);
        }
        return max(0, $index - 1);
    }

    // ── csv ───────────────────────────────────────────────────────────────────

    private static function csvRows(string $path, int $offset, int $limit): array
    {
        $fh = fopen($path, 'r');
        if (!$fh) {
            return [];
        }

        for ($i = 0; $i < $offset; $i++) {
            if (fgetcsv($fh) === false) {
                fclose($fh);
                return [];
            }
        }

        $rows = [];
        for ($i = 0; $i < $limit; $i++) {
            $row = fgetcsv($fh);
            if ($row === false) {
                break;
            }
            $rows[] = array_map(fn ($v) => $v ?? '', $row);
        }

        fclose($fh);
        return $rows;
    }
}

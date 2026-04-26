<?php

namespace EduMicro\DaisyLw4\Imports;

use Closure;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

/**
 * Generic chunk reader used by the daisylw4 Spreadsheet Importer SFC.
 *
 * Processes rows from any xlsx/csv file, applies the user-defined column
 * mapping, and invokes a closure after each chunk of mapped rows. The caller
 * (the SFC) is responsible for what to do with those rows — this class
 * has zero domain knowledge.
 *
 * Column mapping shape: ['colIndex' => 'domainKey' | null | '']
 *   - null / '' → column is ignored, its key will NOT appear in the output row
 *   - 'domainKey' → the value goes into $row['domainKey']
 *
 * Output row shape: ['domainKey' => value, ...]  — only mapped columns present.
 *
 * Usage:
 *   $import = new SpreadsheetChunkImport(
 *       mapping:  ['0' => 'ticket', '1' => null, '2' => 'plate'],
 *       onChunk:  fn($rows) => $this->dispatch('row-imported', rows: $rows),
 *   );
 *   Excel::import($import, $path, null, $readerType);
 *   $import->finish();  // flush any remaining buffered rows
 *
 * Note on Livewire event timing: all $this->dispatch() calls within a single
 * Livewire action are queued and sent to the client together when the action
 * returns. Real-time row-by-row progress is not achievable with this pattern
 * in a standard HTTP cycle.
 */
class SpreadsheetChunkImport implements OnEachRow, WithChunkReading, WithStartRow
{
    public int $processed = 0;
    public int $skipped   = 0;

    private array $buffer = [];

    /**
     * @param  array<string, string|null>  $mapping    Column index (string) → domain key or null/''
     * @param  Closure(list<array>): void  $onChunk    Called with a batch of mapped rows
     * @param  int                         $chunkSize  Rows per batch and maatwebsite internal chunk size
     */
    public function __construct(
        private readonly array   $mapping,
        private readonly Closure $onChunk,
        private readonly int     $chunkSize = 500,
    ) {}

    /** Skip the header row. */
    public function startRow(): int { return 2; }

    public function chunkSize(): int { return $this->chunkSize; }

    public function onRow(Row $row): void
    {
        $this->processRaw(array_values($row->toArray()));
    }

    /**
     * Process a raw row (0-indexed values array) directly, without a maatwebsite Row object.
     * Exposed as public to allow unit testing without instantiating Row.
     *
     * @param  list<mixed>  $rawValues
     */
    public function processRaw(array $rawValues): void
    {
        $mapped = $this->mapRow($rawValues);

        if ($mapped === null) {
            $this->skipped++;
            return;
        }

        $this->buffer[] = $mapped;
        $this->processed++;

        if (count($this->buffer) >= $this->chunkSize) {
            $this->flush();
        }
    }

    /**
     * Flush any remaining buffered rows.
     * Must be called by the SFC after Excel::import() completes.
     */
    public function finish(): void
    {
        if (!empty($this->buffer)) {
            $this->flush();
        }
    }

    /**
     * Map a row's raw values (0-indexed) to the configured domain keys.
     * Columns mapped to null or '' are omitted from the result.
     * Returns null when no mapped values exist (row is counted as skipped).
     *
     * @param  list<mixed>  $rawValues
     * @return array<string, mixed>|null
     */
    public function mapRow(array $rawValues): ?array
    {
        $result = [];

        foreach ($this->mapping as $colIndex => $domainKey) {
            if ($domainKey === null || $domainKey === '') {
                continue;
            }
            $result[$domainKey] = $rawValues[(int) $colIndex] ?? null;
        }

        return empty($result) ? null : $result;
    }

    private function flush(): void
    {
        ($this->onChunk)($this->buffer);
        $this->buffer = [];
    }
}

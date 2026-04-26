<?php

namespace EduMicro\DaisyLw4\Imports;

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

/**
 * PhpSpreadsheet read filter that loads only the first N rows.
 *
 * Used by the daisylw4 Spreadsheet Importer SFC to read headers and preview
 * rows efficiently without loading a large xlsx file into memory.
 */
class PreviewReadFilter implements IReadFilter
{
    public function __construct(private readonly int $maxRow) {}

    public function readCell($columnAddress, $row, $worksheetName = ''): bool
    {
        return $row <= $this->maxRow;
    }
}

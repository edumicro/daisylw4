<?php
use EduMicro\DaisyLw4\Imports\PreviewReadFilter;
use EduMicro\DaisyLw4\Imports\SpreadsheetChunkImport;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * DaisyLW4 Spreadsheet Importer — Single-File Component
 *
 * 4-step wizard: upload → map columns → import → results
 * Domain-agnostic: zero knowledge of what the rows mean.
 *
 * Usage:
 *   <livewire:daisylw4.import.spreadsheet
 *       :columns="[
 *           ['key' => 'ticket',  'label' => 'Ticket',  'required' => true],
 *           ['key' => 'plate',   'label' => 'Placa',   'required' => false],
 *       ]"
 *       :config="[
 *           'chunkSize'   => 500,
 *           'previewRows' => 5,
 *           'on' => [
 *               'chunk' => 'handleImportChunk',   // parent #[On('handleImportChunk')] rows: array
 *               'done'  => 'handleImportDone',    // parent #[On('handleImportDone')]  processed:, skipped:
 *               'error' => 'handleImportError',   // parent #[On('handleImportError')] message:
 *           ],
 *       ]"
 *   />
 *
 * Column shape  { key: string, label: string, required?: bool }
 *
 * Auto-mapping: exact case-insensitive match of col.key or col.label against
 * the file header only — no slug normalisation. "InTime" does NOT auto-map
 * to "in_time". If in doubt, the user must confirm manually.
 *
 * Livewire event note: $this->dispatch() calls during executeImport() are
 * queued and delivered to the client after the action completes. For large
 * files (500k+ rows), the parent should queue chunk work rather than
 * process it inline.
 *
 * Error feedback (parent → SFC):
 *   $this->dispatch('import-row-error', message: '…', row: […])
 *   Adds to the error log shown in step 4 (capped at 50 entries).
 */

new class extends Component {
    use WithFileUploads;

    #[Locked] public array $columns = [];
    #[Locked] public array $config  = [];

    public mixed  $file      = null;
    public string $fileName  = '';
    public string $fileType  = '';
    public string $fileError = '';

    public array $headers     = [];
    public array $previewRows = [];
    public int   $totalRows   = 0;

    public array $pendingMapping = [];
    public int   $processedRows  = 0;
    public int   $skippedRows    = 0;
    public array $importErrors   = [];

    /** Absolute path to a pre-existing server-side file (serverFile mode). */
    public string $serverFilePath = '';
    /** UUID issued when an async job is dispatched; consumed by the Echo listener. */
    public string $asyncImportId  = '';

    public int $step = 1;

    public function updatedFile(): void
    {
        $this->fileError   = '';
        $this->headers     = [];
        $this->previewRows = [];
        $this->totalRows   = 0;
        $this->fileName    = '';
        $this->step        = 1;

        if (! $this->file) return;

        $ext = strtolower($this->file->getClientOriginalExtension());

        if (! in_array($ext, ['xlsx', 'xls', 'csv'])) {
            $this->fileError = 'Formato não suportado. Use xlsx, xls ou csv.';
            $this->file      = null;
            return;
        }

        $this->fileType = $ext;
        $this->fileName = $this->file->getClientOriginalName();
        $previewLimit   = (int) ($this->config['previewRows'] ?? 5);
        $path           = $this->file->getRealPath();

        try {
            if ($ext === 'csv') {
                $this->loadCsvPreview($path, $previewLimit);
            } else {
                $this->loadXlsxPreview($path, $previewLimit, $ext === 'xls' ? 'Xls' : 'Xlsx');
            }
            $this->step = 2;
        } catch (\Throwable $e) {
            $this->fileError = 'Erro ao ler o arquivo: ' . $e->getMessage();
            $this->file      = null;
        }
    }

    private function loadXlsxPreview(string $path, int $limit, string $readerType): void
    {
        $reader = IOFactory::createReader($readerType);
        $info   = $reader->listWorksheetInfo($path);
        $this->totalRows = max(0, ($info[0]['totalRows'] ?? 1) - 1);

        $reader->setReadFilter(new PreviewReadFilter($limit + 1));
        $sheet = $reader->load($path)->getActiveSheet();
        $rows  = $sheet->toArray(null, true, true, false);

        if (empty($rows)) return;

        $this->headers     = array_map('strval', array_values(array_shift($rows)));
        $this->previewRows = array_values(array_slice($rows, 0, $limit));
    }

    private function loadCsvPreview(string $path, int $limit): void
    {
        $handle = fopen($path, 'r');
        if (! $handle) return;

        $this->headers = array_map('strval', fgetcsv($handle) ?: []);

        $count   = 0;
        $preview = [];

        while (($row = fgetcsv($handle)) !== false) {
            $count++;
            if (count($preview) < $limit) {
                $preview[] = $row;
            }
        }

        fclose($handle);
        $this->totalRows   = $count;
        $this->previewRows = $preview;
    }

    public function prepareImport(array $mapping): void
    {
        $this->pendingMapping = $mapping;
        $this->processedRows  = 0;
        $this->skippedRows    = 0;
        $this->importErrors   = [];
        $this->step           = 3;
    }

    /**
     * serverFile mode: load preview for a file already stored on the server.
     *
     * The path is validated to be inside storage/imports/{hospitalId}/ to prevent
     * directory traversal. Called from the Alpine file-picker in step 1.
     */
    public function selectServerFile(string $path, string $name): void
    {
        $this->fileError = '';
        $hospitalId      = (int) ($this->config['hospitalId'] ?? 0);
        $allowed         = realpath(storage_path('imports/' . $hospitalId)) ?: '';
        $real            = realpath($path) ?: '';

        if ($allowed === '' || $real === '' || ! str_starts_with($real, $allowed)) {
            $this->fileError = 'Arquivo inválido ou fora do diretório permitido.';
            return;
        }

        $ext = strtolower(pathinfo($real, PATHINFO_EXTENSION));
        if (! in_array($ext, ['xlsx', 'xls', 'csv'])) {
            $this->fileError = 'Formato não suportado. Use xlsx, xls ou csv.';
            return;
        }

        $this->serverFilePath = $real;
        $this->fileType       = $ext;
        $this->fileName       = $name;
        $previewLimit         = (int) ($this->config['previewRows'] ?? 5);

        try {
            if ($ext === 'csv') {
                $this->loadCsvPreview($real, $previewLimit);
            } else {
                $this->loadXlsxPreview($real, $previewLimit, $ext === 'xls' ? 'Xls' : 'Xlsx');
            }
            $this->step = 2;
        } catch (\Throwable $e) {
            $this->fileError = 'Erro ao ler o arquivo: ' . $e->getMessage();
        }
    }

    public function executeImport(): void
    {
        if ($this->step !== 3) return;

        $async = (bool) ($this->config['async'] ?? false);

        if ($async) {
            $this->executeAsyncImport();
            return;
        }

        if (! $this->file && $this->serverFilePath === '') return;

        $chunkEvent = $this->config['on']['chunk'] ?? 'spreadsheet-chunk';
        $doneEvent  = $this->config['on']['done']  ?? 'spreadsheet-done';
        $filePath   = $this->serverFilePath !== '' ? $this->serverFilePath : $this->file->getRealPath();

        $import = new SpreadsheetChunkImport(
            mapping:   $this->pendingMapping,
            onChunk:   fn(array $rows) => $this->dispatch($chunkEvent, rows: $rows),
            chunkSize: (int) ($this->config['chunkSize'] ?? 500),
        );

        $rt = match ($this->fileType) {
            'xls'   => \Maatwebsite\Excel\Excel::XLS,
            'csv'   => \Maatwebsite\Excel\Excel::CSV,
            default => \Maatwebsite\Excel\Excel::XLSX,
        };

        Excel::import($import, $filePath, null, $rt);
        $import->finish();

        $this->processedRows = $import->processed;
        $this->skippedRows   = $import->skipped;

        $this->dispatch($doneEvent,
            processed: $import->processed,
            skipped:   $import->skipped,
            errors:    $this->importErrors,
        );

        $this->step = 4;
    }

    private function executeAsyncImport(): void
    {
        $hospitalId = (int) ($this->config['hospitalId'] ?? 0);

        if ($this->serverFilePath !== '') {
            $storedPath = $this->serverFilePath;
        } elseif ($this->file) {
            $importId = (string) Str::uuid();
            $dir      = storage_path("imports/{$hospitalId}");
            File::ensureDirectoryExists($dir);
            $storedPath = $dir . '/' . $importId . '.' . $this->fileType;
            copy($this->file->getRealPath(), $storedPath);
        } else {
            $this->step = 4;
            return;
        }

        $importId              = $importId ?? (string) Str::uuid();
        $this->asyncImportId   = $importId;

        $dispatchEvent = $this->config['on']['dispatch'] ?? 'spreadsheet-dispatch';
        $this->dispatch($dispatchEvent,
            importId:  $importId,
            filePath:  $storedPath,
            mapping:   $this->pendingMapping,
            fileType:  $this->fileType,
            totalRows: $this->totalRows,
        );

        $this->step = 4;
    }

    #[On('import-row-error')]
    public function addImportError(string $message, array $row = []): void
    {
        if (count($this->importErrors) < 50) {
            $this->importErrors[] = compact('message', 'row');
        }
    }

    public function resetImporter(): void
    {
        $this->reset([
            'file', 'fileName', 'fileType', 'fileError',
            'headers', 'previewRows', 'totalRows',
            'pendingMapping', 'processedRows', 'skippedRows', 'importErrors',
            'serverFilePath', 'asyncImportId',
        ]);
        $this->step = 1;
    }
}; ?>

@php
$cfg = array_merge([
    'chunkSize'   => 500,
    'previewRows' => 5,
    'on'          => [],
], $config ?? []);
@endphp

<div
    x-data="__daisylw4Spreadsheet({{ Js::from($cfg) }}, {{ Js::from($columns) }})"
    class="card bg-base-100 shadow"
>
    <div class="card-body p-4 gap-4">

        {{-- ── Steps indicator ──────────────────────────────────────────── --}}
        <ul class="steps steps-horizontal text-xs w-full">
            <li class="step" :class="$wire.step >= 1 ? 'step-primary' : ''">Upload</li>
            <li class="step" :class="$wire.step >= 2 ? 'step-primary' : ''">Mapear</li>
            <li class="step" :class="$wire.step >= 3 ? 'step-primary' : ''">Importar</li>
            <li class="step" :class="$wire.step >= 4 ? 'step-primary' : ''">Concluído</li>
        </ul>

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{--  STEP 1 — Upload (or serverFile picker)                         --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        <div x-show="$wire.step === 1">

            {{-- serverFile mode: show list of pre-existing server files --}}
            <template x-if="cfg.serverFiles && cfg.serverFiles.length > 0">
                <div class="space-y-2">
                    <p class="text-sm text-base-content/60 mb-3">Selecione um arquivo para importar:</p>
                    <template x-for="sf in cfg.serverFiles" :key="sf.path">
                        <button
                            type="button"
                            @click="$wire.selectServerFile(sf.path, sf.name)"
                            class="w-full flex items-center gap-3 p-3 rounded-lg border border-base-300 hover:border-primary/60 hover:bg-base-200/40 transition-colors text-left"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-sm truncate" x-text="sf.name"></p>
                                <p class="text-xs text-base-content/40" x-text="sf.sizeLabel ?? ''"></p>
                            </div>
                        </button>
                    </template>

                    <div wire:loading wire:target="selectServerFile" class="flex items-center justify-center gap-2 mt-2 text-sm text-base-content/60">
                        <span class="loading loading-spinner loading-sm"></span>
                        <span>Lendo arquivo…</span>
                    </div>
                </div>
            </template>

            {{-- upload mode (default) --}}
            <template x-if="!cfg.serverFiles || cfg.serverFiles.length === 0">
                <div>
                    <div
                        @click="$refs.fileInput.click()"
                        class="flex flex-col items-center justify-center border-2 border-dashed border-base-content/20 rounded-xl p-10 cursor-pointer hover:border-primary/60 hover:bg-base-200/40 transition-colors gap-3"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <div class="text-center">
                            <p class="font-medium">Clique para selecionar</p>
                            <p class="text-xs text-base-content/40 mt-1">xlsx &bull; xls &bull; csv</p>
                        </div>
                    </div>

                    <input
                        x-ref="fileInput"
                        type="file"
                        class="hidden"
                        wire:model="file"
                        accept=".xlsx,.xls,.csv"
                    >

                    <div wire:loading wire:target="file" class="flex items-center justify-center gap-2 mt-4 text-sm text-base-content/60">
                        <span class="loading loading-spinner loading-sm"></span>
                        <span>Lendo arquivo…</span>
                    </div>
                </div>
            </template>

            <div x-show="$wire.fileError" class="alert alert-error mt-4 text-sm gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span x-text="$wire.fileError"></span>
            </div>

        </div>

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{--  STEP 2 — Column mapping                                        --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        <div x-show="$wire.step === 2">

            {{-- File info bar --}}
            <div class="flex items-center justify-between mb-4 gap-2 flex-wrap text-sm">
                <div class="flex items-center gap-2 min-w-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="font-medium truncate" x-text="$wire.fileName"></span>
                    <span class="badge badge-ghost badge-sm shrink-0"
                          x-text="Number($wire.totalRows).toLocaleString() + ' linhas'"></span>
                </div>
                <button @click="$wire.resetImporter()" class="btn btn-ghost btn-xs shrink-0">Trocar arquivo</button>
            </div>

            {{-- Preview table --}}
            <div class="overflow-x-auto rounded-lg border border-base-300 mb-5 max-h-36">
                <table class="table table-xs table-zebra">
                    <thead>
                        <tr>
                            <template x-for="(h, i) in $wire.headers" :key="i">
                                <th class="whitespace-nowrap" x-text="h"></th>
                            </template>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(row, ri) in $wire.previewRows" :key="ri">
                            <tr>
                                <template x-for="(cell, ci) in row" :key="ci">
                                    <td class="whitespace-nowrap max-w-[8rem] truncate" x-text="cell ?? ''"></td>
                                </template>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            {{-- Column mapping grid — left: Excel header, right: model field --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-5">
                <template x-for="(h, i) in $wire.headers" :key="i">
                    <div class="flex items-center gap-2">
                        <div class="w-36 shrink-0">
                            <span class="text-sm font-mono truncate block" x-text="h"></span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-base-content/30 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                        <select
                            class="select select-sm select-bordered flex-1 min-w-0"
                            :value="mapping[String(i)] ?? ''"
                            @change="assignMapping(String(i), $event.target.value)"
                        >
                            <option value="">— não mapear —</option>
                            <template x-for="col in cols" :key="col.key">
                                <option :value="col.key" x-text="col.label + (col.required ? ' *' : '')"></option>
                            </template>
                        </select>
                    </div>
                </template>
            </div>

            {{-- Required fields not yet mapped --}}
            <template x-if="!allRequiredMapped">
                <p class="text-xs text-error mb-3">
                    Campos obrigatórios sem mapeamento:
                    <span x-text="cols.filter(c => c.required && !Object.values(mapping).includes(c.key)).map(c => c.label + ' *').join(', ')"></span>
                </p>
            </template>

            {{-- Actions --}}
            <div class="flex justify-end gap-2">
                <button @click="$wire.resetImporter()" class="btn btn-ghost btn-sm">Cancelar</button>
                <button
                    @click="confirmMapping()"
                    class="btn btn-primary btn-sm"
                    :disabled="!allRequiredMapped"
                >
                    Importar&nbsp;<span x-text="Number($wire.totalRows).toLocaleString()"></span>&nbsp;linhas
                </button>
            </div>

        </div>

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{--  STEP 3 — Importing (indeterminate progress)                    --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        <div x-show="$wire.step === 3" class="flex flex-col items-center gap-4 py-8">
            <span class="loading loading-spinner loading-lg text-primary"></span>
            <div class="text-center">
                <p class="font-medium">Importando…</p>
                <p class="text-sm text-base-content/50 mt-1">
                    <span x-text="Number($wire.totalRows).toLocaleString()"></span> linhas · não feche esta página
                </p>
            </div>
            <progress class="progress progress-primary w-full max-w-xs"></progress>
        </div>

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{--  STEP 4 — Done (sync) or Processing (async)                     --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        <div x-show="$wire.step === 4">

            {{-- ASYNC branch: job still running or just finished ─────────── --}}
            <template x-if="cfg.async">
                <div>
                    <template x-if="!asyncDone">
                        <div class="flex flex-col items-center gap-4 py-6">
                            <span class="loading loading-spinner loading-lg text-primary"></span>
                            <div class="text-center">
                                <p class="font-medium">Processando em segundo plano…</p>
                                <p class="text-sm text-base-content/50 mt-1">
                                    <span x-show="asyncTotal > 0">
                                        <span x-text="Number(asyncProcessed).toLocaleString()"></span>
                                        /
                                        <span x-text="Number(asyncTotal).toLocaleString()"></span>
                                        linhas
                                    </span>
                                    <span x-show="asyncTotal === 0">Aguardando início…</span>
                                </p>
                            </div>
                            <progress
                                class="progress progress-primary w-full max-w-xs"
                                :value="asyncPercent"
                                max="100"
                            ></progress>
                        </div>
                    </template>

                    <template x-if="asyncDone && asyncResult">
                        <div>
                            <div class="stats stats-vertical md:stats-horizontal shadow w-full mb-4">
                                <div class="stat">
                                    <div class="stat-title">Importados</div>
                                    <div class="stat-value text-success" x-text="Number(asyncResult.imported).toLocaleString()"></div>
                                </div>
                                <div class="stat">
                                    <div class="stat-title">Duplicados</div>
                                    <div class="stat-value text-warning" x-text="Number(asyncResult.duplicates).toLocaleString()"></div>
                                </div>
                                <template x-if="asyncResult.errors > 0">
                                    <div class="stat">
                                        <div class="stat-title">Erros</div>
                                        <div class="stat-value text-error" x-text="asyncResult.errors"></div>
                                    </div>
                                </template>
                                <template x-if="asyncResult.unknown_count > 0">
                                    <div class="stat">
                                        <div class="stat-title">Dispositivos desconhecidos</div>
                                        <div class="stat-value text-warning" x-text="asyncResult.unknown_count"></div>
                                    </div>
                                </template>
                            </div>

                            <template x-if="asyncResult.unknown_devices && asyncResult.unknown_devices.length > 0">
                                <div class="alert alert-warning mb-4 text-sm">
                                    <span>Dispositivos não mapeados (configure fk_outer_id nos nodos):</span>
                                    <code class="ml-1 text-xs" x-text="asyncResult.unknown_devices.join(', ')"></code>
                                </div>
                            </template>

                            <template x-if="asyncResult.error_log && asyncResult.error_log.length > 0">
                                <div class="collapse collapse-arrow bg-error/10 border border-error/30 mb-4 rounded-lg">
                                    <input type="checkbox">
                                    <div class="collapse-title text-sm font-medium text-error">
                                        Erros (<span x-text="asyncResult.error_log.length"></span>
                                        <template x-if="asyncResult.errors > 50"><span>, mostrando primeiros 50</span></template>)
                                    </div>
                                    <div class="collapse-content">
                                        <ul class="text-xs space-y-1 mt-1 text-base-content/70">
                                            <template x-for="(e, i) in asyncResult.error_log" :key="i">
                                                <li><span class="font-mono" x-text="e.row"></span>: <span x-text="e.reason"></span></li>
                                            </template>
                                        </ul>
                                    </div>
                                </div>
                            </template>

                            <div class="flex justify-end">
                                <button @click="$wire.resetImporter(); asyncDone = false; asyncResult = null; asyncPercent = 0;" class="btn btn-primary btn-sm">
                                    Nova importação
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            {{-- SYNC branch: import finished inline ─────────────────────── --}}
            <template x-if="!cfg.async">
                <div>
                    <div class="stats stats-vertical md:stats-horizontal shadow w-full mb-4">
                        <div class="stat">
                            <div class="stat-title">Importados</div>
                            <div class="stat-value text-success"
                                 x-text="Number($wire.processedRows).toLocaleString()"></div>
                        </div>
                        <div class="stat">
                            <div class="stat-title">Ignorados</div>
                            <div class="stat-value text-warning"
                                 x-text="Number($wire.skippedRows).toLocaleString()"></div>
                        </div>
                        <template x-if="$wire.importErrors.length > 0">
                            <div class="stat">
                                <div class="stat-title">Erros</div>
                                <div class="stat-value text-error" x-text="$wire.importErrors.length"></div>
                            </div>
                        </template>
                    </div>

                    <template x-if="$wire.importErrors.length > 0">
                        <div class="collapse collapse-arrow bg-error/10 border border-error/30 mb-4 rounded-lg">
                            <input type="checkbox">
                            <div class="collapse-title text-sm font-medium text-error">
                                Erros (<span x-text="$wire.importErrors.length"></span>
                                <template x-if="$wire.importErrors.length >= 50">
                                    <span>, mostrando primeiros 50</span>
                                </template>)
                            </div>
                            <div class="collapse-content">
                                <ul class="text-xs space-y-1 mt-1 text-base-content/70">
                                    <template x-for="(err, i) in $wire.importErrors" :key="i">
                                        <li x-text="err.message"></li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </template>

                    <div class="flex justify-end">
                        <button @click="$wire.resetImporter()" class="btn btn-primary btn-sm">
                            Nova importação
                        </button>
                    </div>
                </div>
            </template>

        </div>

    </div>
</div>

<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ImportedFilesData extends Data
{
    public function __construct(
        public ?array $importedFilesList,
    ) {
    }

    public function isEmpty(): bool
    {
        return empty($this->importedFilesList);
    }
}

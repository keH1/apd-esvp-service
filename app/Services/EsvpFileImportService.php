<?php

namespace App\Services;

use App\Actions\ImportFileAction;

class EsvpFileImportService
{
    public function __construct(protected ImportFileAction $importFileAction)
    {
    }

    public function import(): void
    {
        $this->importFileAction->execute();
    }
}

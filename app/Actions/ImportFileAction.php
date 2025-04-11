<?php

namespace App\Actions;

use App\Imports\PointsAccrualImport;
use App\Repositories\ImportFileRepository;
use Maatwebsite\Excel\Facades\Excel;

class ImportFileAction
{
    public function __construct(protected ImportFileRepository $fileRepository)
    {
    }

    public function execute(): void
    {
        $files = $this->fileRepository->listFiles();
        foreach ($files as $file) {
            Excel::import(new PointsAccrualImport(), $file, 'local');
            $this->fileRepository->moveFileToDone($file);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Actions\ImportFileAction;
use App\Repositories\ImportFileRepository;

class TestController extends Controller
{
    public function __invoke(ImportFileAction $fileRepository)
    {
        $fileRepository->execute();
    }
}

<?php

namespace App\Console\Commands;

use App\Services\EsvpFileImportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class EsvpImportCommand extends Command
{
    protected $signature = 'esvp:import';

    protected $description = 'Импортирует данные из файла';

    public function handle(EsvpFileImportService $importService): void
    {
        try {
            $this->info("Запуск импорта файлов из ESVP...");

            $importService->import();

            $this->info("Импорт завершён успешно.");
        } catch (\Throwable $e) {
            Log::error("Ошибка импорта ESVP файлов: " . $e->getMessage());
            $this->error("Ошибка импорта: " . $e->getMessage());
        }
    }
}

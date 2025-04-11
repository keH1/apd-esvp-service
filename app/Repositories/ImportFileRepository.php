<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

/**
 * Репозиторий обработки файла импорта из ЕСВП
 */
class ImportFileRepository
{
    protected string $importDirectory = 'import';
    protected string $doneDirectory = 'import/done';

    /**
     * Возвращает список файлов импорта.
     *
     * @return array
     */
    public function listFiles(): array
    {
        return Storage::disk(config('filesystems.default'))->files($this->importDirectory);
    }

    /**
     * Перемещает файл из каталога импорта в каталог "done".
     *
     * @param string $file Относительный путь к файлу (например, "import/example.xlsx")
     * @return bool
     */
    public function moveFileToDone(string $file): bool
    {
        if (!Storage::disk(config('filesystems.default'))->exists($this->doneDirectory)) {
            $this->makeDoneDirectory();
        }

        $destination = $this->doneDirectory . DIRECTORY_SEPARATOR . basename($file);
        return Storage::disk(config('filesystems.default'))->move($file, $destination);
    }

    /**
     * Удаляет указанный файл.
     *
     * @param string $filename Относительный путь к файлу
     * @return bool
     */
    public function deleteFile(string $filename): bool
    {
        return Storage::disk(config('filesystems.default'))->delete($filename);
    }

    /**
     * Создает директорию done
     *
     * @return bool
     */
    protected function makeDoneDirectory(): bool
    {
        return Storage::disk(config('filesystems.default'))->makeDirectory($this->doneDirectory);
    }
}

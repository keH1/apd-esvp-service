<?php

namespace App\Imports;

use App\Data\PointsAccrualData;
use App\Services\PointsAccrualService;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class PointsAccrualImport implements OnEachRow, WithChunkReading, WithHeadingRow
{
    use RemembersChunkOffset;

    private PointsAccrualService $service;

    public function __construct()
    {
        $this->service = app(PointsAccrualService::class);
    }

    /**
     * Обрабатывает каждую строку файла.
     *
     * @inheritDoc
     */
    public function onRow(Row $row): void
    {
        $pointsAccrualData = PointsAccrualData::from($row);
        $this->service->createRecord($pointsAccrualData);
    }

    public function chunkSize(): int
    {
        return config('app.import_chunk_size');
    }
}

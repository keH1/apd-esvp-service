<?php

namespace App\Actions;

use App\Data\PointsAccrualData;
use App\Repositories\PointsAccrualRepository;

readonly class CreatePointAccrualAction
{
    public function __construct(private PointsAccrualRepository $repository)
    {
    }

    public function execute(PointsAccrualData $data): PointsAccrualData
    {
        $registryRecord = $this->repository->create($data);
        $data->id = $registryRecord->id;

        return $data;
    }
}

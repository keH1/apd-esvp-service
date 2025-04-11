<?php

namespace App\Services;

use App\Actions\CreatePointAccrualAction;
use App\Data\PointsAccrualData;
use App\Events\PointsAccrualRegistered;
use Exception;
use Illuminate\Support\Facades\Log;

class PointsAccrualService
{
    public function __construct(
        private readonly CreatePointAccrualAction $createPointAccrualAction,
    ) {
    }

    /**
     * Обёртка для создания записи, которая дополнительно диспатчит событие.
     */
    public function createRecord(PointsAccrualData $data): ?PointsAccrualData
    {
        try {
            $createdData = $this->createPointAccrualAction->execute($data);
            event(new PointsAccrualRegistered($createdData));

            return $createdData;
        } catch (Exception $e) {
            Log::error("Ошибка создания записи начисления баллов: " . $e->getMessage());
            return null;
        }
    }
}

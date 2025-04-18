<?php

namespace App\Services;

use App\Actions\ImportFileAction;
use App\Services\Kafka\PointsAccrualKafkaService;

class EsvpFileImportService
{
    public function __construct(protected ImportFileAction $importFileAction, protected PointsAccrualKafkaService $kafkaService)
    {
    }

    public function import(): void
    {
        $importData = $this->importFileAction->execute();

        if (!$importData->isEmpty()) {
            $this->kafkaService->sendImportCompletedMessage($importData);
        }
    }
}

<?php

namespace App\Services\Kafka;

use App\Data\ImportedFilesData;
use App\Data\PointsAccrualData;
use App\Repositories\PointsAccrualRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Junges\Kafka\Facades\Kafka;
use Spatie\LaravelData\Data;

class PointsAccrualKafkaService
{
    public function __construct(protected PointsAccrualRepository $repository)
    {
    }

    /**
     * Отправляет сообщение в Kafka и, в случае успеха, обновляет статус записи.
     *
     * @param  PointsAccrualData  $data  DTO с данными записи. DTO содержит свойство id, установленное после создания.
     */
    public function sendMessageAndMarkAsSent(PointsAccrualData $data): bool
    {
        try {
            $topic = config('kafka.esvp_topic');
            $this->publishToKafka($data, $topic);
            return $this->repository->markAsSent($data->id);
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['data' => $data->toArray()]);

            return false;
        }
    }

    /**
     * Отправляет сообщение о том что все файлы успешно импортированы в реестр
     *
     * @param  \App\Data\ImportedFilesData  $data
     * @return bool
     */
    public function sendImportCompletedMessage(ImportedFilesData $data): bool
    {
        try {
            $topic = config('kafka.esvp_notification_topic');
            return $this->publishToKafka($data, $topic);
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['data' => $data->toArray()]);

            return false;
        }
    }

    /**
     * Отправляет сообщение в кафку
     *
     * @param  array|\Spatie\LaravelData\Data  $payload
     * @param  string  $topic
     * @return bool
     * @throws \Exception
     */
    private function publishToKafka(array|Data $payload, string $topic): bool
    {
        $result = Kafka::publish()->onTopic($topic)->withBody($payload)->send();
        if (!$result) {
            throw new Exception("Failed to send message to topic [$topic]");
        }

        return true;
    }
}

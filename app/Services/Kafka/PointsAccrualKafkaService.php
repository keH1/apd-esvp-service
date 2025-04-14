<?php

namespace App\Services\Kafka;

use App\Data\PointsAccrualData;
use App\Repositories\PointsAccrualRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Junges\Kafka\Facades\Kafka;

class PointsAccrualKafkaService
{
    private string $topic;

    public function __construct(protected PointsAccrualRepository $repository)
    {
        $this->topic = config('kafka.esvp_topic');
    }

    /**
     * Отправляет сообщение в Kafka и, в случае успеха, обновляет статус записи.
     *
     * @param  PointsAccrualData  $data  DTO с данными записи. DTO содержит свойство id, установленное после создания.
     * @return bool
     * @throws \Exception
     */
    public function sendMessageAndMarkAsSent(PointsAccrualData $data): bool
    {
        try {
            $sendResult = Kafka::publish()->onTopic($this->topic)->withBody($data)->send();
            if (!$sendResult) {
                throw new Exception('Error sending message to Kafka');
            }

            return $this->repository->markAsSent($data->id);
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['data' => $data->toArray()]);
            throw new Exception('Error sending message to Kafka', previous: $e);
        }
    }
}

<?php

namespace App\Listeners;

use App\Events\PointsAccrualRegistered;
use App\Services\Kafka\PointsAccrualKafkaService;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendToKafkaListener implements ShouldQueue
{
    public function __construct(protected PointsAccrualKafkaService $pointsAccrualKafkaService)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(PointsAccrualRegistered $event): void
    {
        $this->pointsAccrualKafkaService->sendMessageAndMarkAsSent($event->data);
    }
}

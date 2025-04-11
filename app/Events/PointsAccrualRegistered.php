<?php

namespace App\Events;

use App\Data\PointsAccrualData;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PointsAccrualRegistered
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public PointsAccrualData $data)
    {
    }
}

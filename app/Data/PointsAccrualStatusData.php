<?php

namespace App\Data;

use App\Models\PointsAccrualStatus;
use Spatie\LaravelData\Data;

class PointsAccrualStatusData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }

    public static function fromString(string $name): self
    {
        $road = PointsAccrualStatus::firstOrCreate(['name' => $name]);

        return new self($road->id, $road->name);
    }
}

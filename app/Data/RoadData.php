<?php

namespace App\Data;

use App\Models\Road;
use Spatie\LaravelData\Data;

class RoadData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }

    public static function fromString(string $name): self
    {
        $road = Road::firstOrCreate(['name' => $name]);

        return new self($road->id, $road->name);
    }
}

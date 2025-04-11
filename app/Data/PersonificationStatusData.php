<?php

namespace App\Data;

use App\Models\PersonificationStatus;
use Spatie\LaravelData\Data;

class PersonificationStatusData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }

    public static function fromString(string $name): self
    {
        $road = PersonificationStatus::firstOrCreate(['name' => $name]);

        return new self($road->id, $road->name);
    }
}

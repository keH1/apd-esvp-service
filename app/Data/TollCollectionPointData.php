<?php

namespace App\Data;

use App\Models\TollCollectionPoint;
use Spatie\LaravelData\Data;

class TollCollectionPointData extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $name,
    ) {
    }

    public static function fromString(?string $name): ?self
    {
        if (is_null($name)) {
            return null;
        }

        $road = TollCollectionPoint::firstOrCreate(['name' => $name]);

        return new self($road->id, $road->name);
    }
}

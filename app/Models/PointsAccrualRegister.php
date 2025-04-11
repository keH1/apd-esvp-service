<?php

namespace App\Models;

use App\Enums\ClientTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointsAccrualRegister extends Model
{
    protected $fillable = [
        'road_id',
        'travel_identifier',
        'date_of_travel',
        'act',
        'enter_toll_collection_point_id',
        'exit_toll_collection_point_id',
        'client',
        'client_type',
        'personification_status_id',
        'personal_account',
        'kt',
        'pan',
        'email',
        'number_of_points',
        'date_of_points',
        'points_accrual_status_id',
    ];

    public function road(): BelongsTo
    {
        return $this->belongsTo(Road::class);
    }

    public function enterTollCollectionPoint(): BelongsTo
    {
        return $this->belongsTo(TollCollectionPoint::class, 'enter_toll_collection_point_id');
    }

    public function exitTollCollectionPoint(): BelongsTo
    {
        return $this->belongsTo(TollCollectionPoint::class, 'exit_toll_collection_point_id');
    }

    public function personificationStatus(): BelongsTo
    {
        return $this->belongsTo(PersonificationStatus::class);
    }

    public function pointsAccrualStatus(): BelongsTo
    {
        return $this->belongsTo(PointsAccrualStatus::class);
    }

    protected function casts(): array
    {
        return [
            'date_of_travel' => 'datetime',
            'client_type' => ClientTypeEnum::class,
        ];
    }
}

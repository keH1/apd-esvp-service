<?php

namespace App\Repositories;

use App\Data\PointsAccrualData;
use App\Models\PointsAccrualRegister;

class PointsAccrualRepository
{
    /**
     * Создаем запись в реестре
     *
     * @param  \App\Data\PointsAccrualData  $data
     * @return \App\Models\PointsAccrualRegister
     */
    public function create(PointsAccrualData $data): PointsAccrualRegister
    {
        return PointsAccrualRegister::create([
            'road_id' => $data->road->id,
            'travel_identifier' => $data->travel_identifier,
            'date_of_travel' => $data->date_of_travel,
            'act' => $data->act,
            'enter_toll_collection_point_id' => $data->enter_toll_collection_point?->id,
            'exit_toll_collection_point_id' => $data->exit_toll_collection_point?->id,
            'client' => $data->client,
            'client_type' => $data->client_type,
            'personification_status_id' => $data->personification_status->id,
            'personal_account' => $data->personal_account,
            'kt' => $data->kt,
            'pan' => $data->pan,
            'email' => $data->email,
            'number_of_points' => $data->number_of_points,
            'date_of_points' => $data->date_of_points,
            'points_accrual_status_id' => $data->points_accrual_status->id,
        ]);
    }

    /**
     * Обновляет статус, что сообщение отправлено в брокер.
     *
     * @param int $id Идентификатор записи
     * @return bool
     */
    public function markAsSent(int $id): bool
    {
        $record = PointsAccrualRegister::findOrFail($id);
        $record->sent_to_broker = true;
        return $record->save();
    }
}

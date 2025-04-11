<?php

namespace App\Data;

use App\Enums\ClientTypeEnum;
use Carbon\CarbonImmutable;
use Maatwebsite\Excel\Row;
use Spatie\LaravelData\Data;

class PointsAccrualData extends Data
{
    public function __construct(
        public ?int $id,
        public RoadData $road,
        public string $travel_identifier,
        public CarbonImmutable $date_of_travel,
        public string $act,
        public ?TollCollectionPointData $enter_toll_collection_point,
        public ?TollCollectionPointData $exit_toll_collection_point,
        public string $client,
        public ClientTypeEnum $client_type,
        public PersonificationStatusData $personification_status,
        public string $personal_account,
        public string $kt,
        public string $pan,
        public ?string $email,
        public string $number_of_points,
        public CarbonImmutable $date_of_points,
        public PointsAccrualStatusData $points_accrual_status,
    ) {
    }

    public static function fromRow(Row $row): static
    {
        $row = $row->toArray();

        return self::from([
            'road' => $row['doroga'],
            'travel_identifier' => $row['id_proezda'],
            'date_of_travel' => CarbonImmutable::parse($row['data_i_vremia_proezda']),
            'act' => $row['akt'],
            'enter_toll_collection_point' => $row['pvp_vieezda'],
            'exit_toll_collection_point' => $row['pvp_vyezda'],
            'client' => $row['naimenovanie_klienta'],
            'client_type' => $row['tip_klienta'],
            'personification_status' => $row['status_personifikacii'],
            'personal_account' => $row['ls'],
            'kt' => $row['kt'],
            'pan' => $row['pan'],
            'email' => $row['e_mail_iz_kartocki_klienta_v_esvp'],
            'number_of_points' => $row['kolicestvo_ballov'],
            'date_of_points' => CarbonImmutable::parse($row['data_nacisleniia_ballov']),
            'points_accrual_status' => $row['status_nacisleniia_ballov'],
        ]);
    }
}

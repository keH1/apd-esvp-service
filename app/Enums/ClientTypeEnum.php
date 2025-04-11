<?php

namespace App\Enums;

enum ClientTypeEnum: string
{
    case LEGAL_ENTITY = 'ЮЛ';
    case INDIVIDUAL = 'ФЛ';
    case SOLE_PROPRIETOR = 'ИП';
}

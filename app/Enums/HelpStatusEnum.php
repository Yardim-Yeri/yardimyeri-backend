<?php

namespace App\Enums;

enum HelpStatusEnum: string
{
    case PENDING = 'Yardım Bekliyor';
    case PROCESS = 'Yardım Geliyor';
    case SUCCESS = 'Yardım Ulaştı';

    public static function getAllValues(): array
    {
        return array_column(HelpStatusEnum::cases(), 'value');
    }
}

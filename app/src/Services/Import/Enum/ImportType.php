<?php

 namespace App\Services\Import\Enum;

enum ImportType: string
{
    case DAILY = 'per_item';
    case WEEKLY = 'total';
    public static function getCasesAsString(): array
    {
        return array_map(function (ImportType $importType) {
            return $importType->value;
        }, self::cases());
    }
}

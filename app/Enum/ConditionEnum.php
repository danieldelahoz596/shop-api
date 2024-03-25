<?php

namespace App\Enum;

enum ConditionEnum: string {
    case LikeNew = 'Like New';
    case UsedExcellent = 'Used - Excellent';
    case UsedGood = 'Used - Good';
    case UsedFair = 'Used - Fair';

    public static function values(): array {
        return array_column(self::cases(), 'value', 'name');
    }
}

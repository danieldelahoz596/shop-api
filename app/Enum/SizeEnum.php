<?php

namespace App\Enum;

enum SizeEnum: string {
    case XS = 'XS';
    case S = 'S';
    case M = 'M';
    case L = 'L';
    case XL = 'XL';

    public static function values(): array {
        return array_column(self::cases(), 'value', 'name');
    }
}

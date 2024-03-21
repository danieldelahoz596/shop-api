<?php

namespace App\Enum;

enum StyleEnum: string {
    case Retro = 'Retro';
    case Vintage = 'Vintage';
    case Y2K = 'Y2K';
    case Streetwear = 'Streetwear';
    case Athleisure = 'Athleisure';
    case Casual = 'Casual';
    case Formal = 'Formal';
    case Glam = 'Glam';
    case Cottage = 'Cottage';
    case Punk = 'Punk';
    case Preppy = 'Preppy & Chic';
    case Utility = 'Utility';

    public static function values(): array {
        return array_column(self::cases(), 'value', 'name');
    }
}

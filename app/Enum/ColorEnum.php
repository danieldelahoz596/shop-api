<?php

namespace App\Enum;

enum ColorEnum: string {
    case Black = 'Black';
    case White = 'White';
    case Gray = 'Gray';
    case Beige = 'Beige';
    case Red = 'Red';
    case Blue = 'Blue';
    case Green = 'Green';
    case Yellow = 'Yellow';
    case Purple = 'Purple';
    case Pink = 'Pink';
    case Orange = 'Orange';
    case Brown = 'Brown';
    case Navyblue = 'Navy Blue';
    case Silver = 'Silver';
    case Gold = 'Gold';
    case Multicolor = 'Multicolor';

    public static function values(): array {
        return array_column(self::cases(), 'value', 'name');
    }
}

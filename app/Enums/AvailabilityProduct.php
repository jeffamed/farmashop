<?php

namespace App\Enums;

enum AvailabilityProduct: string
{
    case Available = 'available';
    case Low = 'low';
    case OutOfStock = 'out_of_stock';

    public function stock(): string
    {
        return match($this) {
            self::Available => '> 20',
            self::Low => '< 20',
            self::OutOfStock => '0',
        };
    }
}

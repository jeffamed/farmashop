<?php

namespace App\Actions;

class CalculateTotal
{
    public function handle(array $attributes): float
    {
        $qty = $attributes['quantity'] ?? 0;
        $price = $attributes['unit_price'] ?? 0;
        $discount = ($attributes['discount'] ?? 0)/100;
        $subTotal = $qty * $price;
        return $subTotal - ($discount * $subTotal);
    }
}

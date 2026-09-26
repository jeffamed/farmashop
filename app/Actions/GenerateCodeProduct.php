<?php

namespace App\Actions;

use App\Models\Product;

class GenerateCodeProduct
{
    const string PREFIX = "PROD";
    public function handle(): string
    {
        $total = Product::count() + 1;
        $code = strlen((string) $total) > 6 ? (string) $total : $this->additionalZero((string) $total);
        return self::PREFIX . $code;
    }

    private function additionalZero(string $total): string
    {
        return str_pad($total, 6, '0', STR_PAD_LEFT);
    }
}

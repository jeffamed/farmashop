<?php

namespace App\Actions;

use Illuminate\Support\Collection;

class GenerateNicaraguaPhone
{
    public static function handle(string $phone): Collection
    {
        return collect([
            'country' => 'NI',
            'countryCode' => 'NI',
            'formatted' => "+505 {$phone}",
            'valid' => true,
            'possible' => true,
            'nationalNumber' => $phone,
            'countryCallingCode' => '505',
            'number' => "+505{$phone}",
        ]);
    }
}

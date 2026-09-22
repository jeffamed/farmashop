<?php

namespace App\Dtos;

use App\Enums\AvailabilityProduct;

final class FilterProduct
{
    public function __construct(
        public ?AvailabilityProduct $availability = null,
        public ?int $laboratoryId = null,
        public ?int $usageId = null,
        public ?int $typeId = null,
    ) {}
}

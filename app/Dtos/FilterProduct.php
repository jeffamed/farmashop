<?php

namespace App\Dtos;

use App\Enums\AvailabilityProduct;

final class FilterProduct
{
    public function __construct(
        public ?AvailabilityProduct $availability = null,
        public ?array $laboratoryId = null,
        public null|array|int $usageId = null,
        public ?array $typeId = null,
    ) {}
}

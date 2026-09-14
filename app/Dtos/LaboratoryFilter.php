<?php

namespace App\Dtos;

class LaboratoryFilter
{
    public function __construct(
        public string $search,
        public string $input,
        public int $pagination,
        public bool $needPagination
    )
    {}
}

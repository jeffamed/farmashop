<?php

namespace App\Dtos;

class StandardFilter
{
    public function __construct(
        public string $search,
        public string $input,
        public int $pagination,
        public bool $needPagination
    ){}
}

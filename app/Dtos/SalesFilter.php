<?php

namespace App\Dtos;

class SalesFilter
{
    public function __construct(
        public string $condition,
        public string $search,
        public int $pagination)
    {}

    public function toArray(): array
    {
        return [
            'condition' => $this->condition,
            'search' => $this->search,
            'pagination' => $this->pagination,
        ];
    }
}

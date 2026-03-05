<?php

namespace App\Services;

use App\Models\Usage;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UsageService
{
    public function __construct()
    {
    }

    public function getUsages(array $params): Collection|LengthAwarePaginator
    {
        $usages = Usage::query()
            ->latest('id')
            ->when($params['search'], fn(Builder $query, $text) => $query->searchByDescription($text));

        return $params['needPagination'] ? $usages->paginate($params['pagination']) : $usages->get();
    }
}

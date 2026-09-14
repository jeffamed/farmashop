<?php

namespace App\Services;

use App\Models\Usage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UsageService
{
    public function __construct() {}

    public function getUsages(array $params): Collection|LengthAwarePaginator
    {
        $usages = Usage::query()
            ->latest('id')
            ->when($params['search'] ?? null, fn (Builder $query, $text) => $query->searchByDescription($text));

        if ($params['needPagination'] ?? null) {
            return $usages->paginate($params['pagination']);
        }

        return $usages->get();

    }
}

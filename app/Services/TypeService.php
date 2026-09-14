<?php

namespace App\Services;

use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TypeService
{
    public function __construct()
    {
    }

    public function getTypes(array $params): Collection|LengthAwarePaginator
    {
        $types = Type::query()
            ->latest('id')
            ->when($params['search'], fn(Builder $query, $text) => $query->searchName($text));

        if (isset($params['needPagination'])) {
            return $types->paginate($params['pagination']);
        }

        return $types->get();
    }
}

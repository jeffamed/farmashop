<?php

namespace App\Services;

use App\Dtos\LaboratoryFilter;
use App\Models\Laboratory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class LaboratoryService
{
    public function __construct()
    {}

    public function getLaboratories(LaboratoryFilter $params): Collection|LengthAwarePaginator
    {
        $laboratoriesQuery =  Laboratory::query()
            ->latest('id')
            ->when($params['search'], fn(Builder $query, $text) => $query->search($text));

        return $params['needPagination'] ? $laboratoriesQuery->paginate( $params['pagination']) : $laboratoriesQuery->get() ;

    }
}

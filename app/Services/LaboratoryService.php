<?php

namespace App\Services;

use App\Dtos\LaboratoryFilter;
use App\Models\Laboratory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class LaboratoryService
{
    public function __construct()
    {}

    public function getLaboratories(LaboratoryFilter $params): Collection|LengthAwarePaginator
    {
        $filter = new Request([
            'search' => $params->search,
            'column' => $params->input,
        ]);
        $laboratoriesQuery =  Laboratory::query()
            ->latest('id')
            ->when($params->search, fn(Builder $query, $text) => $query->searchColumn($filter));

        return $params->needPagination ? $laboratoriesQuery->paginate($params->pagination) : $laboratoriesQuery->get() ;

    }
}

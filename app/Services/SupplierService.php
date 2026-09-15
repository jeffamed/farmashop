<?php

namespace App\Services;

use App\Dtos\StandardFilter;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SupplierService
{
    public function __construct()
    {
    }

    public function getSuppliers(StandardFilter $params): Collection|LengthAwarePaginator
    {
        $filter = new Request([
            'search' => $params->search,
            'column' => $params->input,
        ]);

        $suppliers = Supplier::query()
            ->latest('id')
            ->when($params->search, fn(Builder $query, $text) => $query->searchColumn($filter));

        return $params->needPagination ? $suppliers->paginate( $params->pagination) : $suppliers->get() ;
    }
}

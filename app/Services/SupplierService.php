<?php

namespace App\Services;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SupplierService
{
    public function __construct()
    {
    }

    public function getSuppliers(array $params): Collection|LengthAwarePaginator
    {
        $suppliers = Supplier::query()
            ->latest('id')
            ->when($params['search'], fn(Builder $query, $text) => $query->search($text));

        return $params['needPagination'] ? $suppliers->paginate( $params['pagination']) : $suppliers->get() ;
    }
}

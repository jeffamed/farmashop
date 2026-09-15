<?php

namespace App\Services;

use App\Dtos\StandardFilter;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CustomerService
{
    public function querySearchMultiColumn(StandardFilter $filter): Collection|LengthAwarePaginator
    {
        $search = "%{$filter->search}%";
        $query = Customer::query()
            ->when($filter->input === 'name',
                fn(Builder $query) => $query->whereAny(['name', 'last_name'], 'like', $search),
                fn(Builder $query) => $query->where($filter->input, 'like', $search))
            ->select('id', 'name', 'last_name', 'dni', 'phone', 'email', 'address')
            ->latest('id');

        return $filter->needPagination ? $query->paginate($filter->pagination) : $query->get();
    }

    public function searchMultiColumn(string $search): Collection
    {
        return $this->querySearchMultiColumn($search , 50)
            ->get()
            ->append('full_name_document')
            ->map(function ($customer) {
                return [
                    'id' => $customer->id,
                    'label' => $customer->full_name_document
                ];
            })
            ->values();
    }
}

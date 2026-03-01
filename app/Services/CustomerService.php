<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CustomerService
{
    public function querySearchMultiColumn(string $search, int $limit = 0): Builder
    {
        $search = "%{$search}%";
        return Customer::query()
            ->whereAny(['name', 'last_name', 'dni'], 'like', $search)
            ->select('id', 'name', 'last_name', 'dni')
            ->latest('id')
            ->when($limit, fn(Builder $query) => $query->take($limit));
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

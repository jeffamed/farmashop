<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;

trait HasSearchScope
{
    #[Scope]
    public function searchColumn(Builder $query, Request $request): Builder
    {
        $search = "%{$request->input('search')}%";
        $column = (string)$request->input('column');
        return $query->where($column, 'like', $search);
    }

    #[Scope]
    public function searchByName(Builder $query, string $name): Builder
    {
        $search = "%{$name}%";
        return $query->where('name', 'like', $search);
    }

    #[Scope]
    public function searchByDescription(Builder $query, string $description): Builder
    {
        $search = "%{$description}%";
        return $query->where('description', 'like', $search);
    }
}

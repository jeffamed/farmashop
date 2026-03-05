<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserService
{
    public function __construct()
    {
    }

    public function getUsers(array $params)
    {
        $usages = User::query()
            ->with('roles')
            ->latest('id')
            ->when($params['search'], fn(Builder $query, $text) => $query->search($text));

        return $params['needPagination'] ? $usages->paginate($params['pagination']) : $usages->get();
    }
}

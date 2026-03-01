<?php

namespace App\Models;

use App\Traits\HasSearchScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder as BuilderQuery;

/**
 * @method static Builder|BuilderQuery search(string $name)
 */
class Laboratory extends Model
{
    use HasFactory, SoftDeletes, HasSearchScope;

    protected $fillable = [
        'name',
        'address',
    ];
}

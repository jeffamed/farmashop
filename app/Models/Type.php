<?php

namespace App\Models;

use App\Traits\HasSearchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * @method static Builder|Builder searchByName(string $name)
 */
class Type extends Model
{
    use HasFactory, SoftDeletes, HasSearchScope;

    protected $fillable = [
        'name',
    ];
}

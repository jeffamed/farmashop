<?php

namespace App\Models;

use App\Traits\HasSearchScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static Builder searchByName(string $name)
 */
class Location extends Model
{
    use HasFactory, SoftDeletes, HasSearchScope;

    protected $fillable = [
        'name',
    ];
}

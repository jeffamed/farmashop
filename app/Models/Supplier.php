<?php

namespace App\Models;

use App\Traits\HasSearchScope;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

/**
 * @method static Builder searchByName(string $name)
 * @method static Builder search(Request $request)
 */
class Supplier extends Model
{
    use HasFactory, SoftDeletes, HasSearchScope;

    protected $fillable = [
        'ruc',
        'name',
        'address',
        'phone',
    ];
}

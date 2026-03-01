<?php

namespace App\Models;

use App\Traits\HasSearchScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static Builder searchByName(string $name)
 */
class Presentation extends Model
{
    use HasFactory, SoftDeletes, HasSearchScope;

    protected $fillable = [
        'name',
    ];
}

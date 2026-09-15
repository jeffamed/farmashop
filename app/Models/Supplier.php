<?php

namespace App\Models;

use App\Traits\HasSearchScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

/**
 * @method static Builder searchColumn(Request $request)
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

    protected function casts(): array
    {
        return[
            'phone' => 'array'
        ];
    }

    protected $appends = ['phone_number'];

    protected function phoneNumber(): Attribute
    {
        return Attribute::make(
            get: function() {
                if (empty($this->phone)) return '';
                return $this->phone['number'] ?? $this->phone;
            }
        );
    }
}

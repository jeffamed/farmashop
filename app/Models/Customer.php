<?php

namespace App\Models;

use App\Traits\HasSearchScope;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use function PHPUnit\Framework\isEmpty;

/**
 * @method static Builder searchColumn(string $name)
 */
class Customer extends Model
{
    use HasFactory, SoftDeletes, HasSearchScope;

    protected $fillable = [
        'dni',
        'name',
        'last_name',
        'address',
        'phone',
        'email',
    ];

    protected $appends = ['phone_number'];
    protected function casts(): array
    {
        return[
            'phone' => 'array'
        ];
    }

    protected function fullNameDocument(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->dni} - {$this->name} {$this->last_name}",
        );
    }

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

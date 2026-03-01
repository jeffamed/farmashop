<?php

namespace App\Models;

use App\Traits\HasSearchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected function fullNameDocument(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->dni} - {$this->name} {$this->last_name}",
        );
    }
}

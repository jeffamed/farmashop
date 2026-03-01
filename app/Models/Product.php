<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'price',
        'stock',
        'discount',
        'box_stock',
        'unit_box',
        'expired_at',
        'laboratory_id',
        'type_id',
        'location_id',
        'supplier_id',
        'presentation_id',
    ];

    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(location::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function usages(): HasMany
    {
        return $this->hasMany(Usage::class);
    }

    public function presentation(): BelongsTo
    {
        return $this->belongsTo(Presentation::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function lastOrderDetails(): HasOne
    {
        return $this->hasOne(OrderDetails::class)->latestOfMany();
    }

    public function cost(): Attribute
    {
        return Attribute::make(
            get: function (){
                return $this->lastOrderDetails()->value('unit_price');
            }
        );
    }

    public function costPrev(): Attribute
    {
        return Attribute::make(
            get: function (){
                $previousOrder = $this->orderDetails()->skip(1)->orderByDesc('created_at')->first();
                return $previousOrder?->unit_price;
            }
        );
    }
    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
        ];
    }
}

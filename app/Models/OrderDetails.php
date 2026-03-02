<?php

namespace App\Models;

use App\Actions\CalculateTotal;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'suggest_price',
        'expire_at',
        'total',
        'discount',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected function casts(): array
    {
        return [
            'expire_at' => 'date',
            'quantity' => 'integer',
            'unit_price' => 'float',
            'discount' => 'float',
            'total' => 'float',
        ];
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (float) $value,
            set: function($value, array $attributes) {
                return CalculateTotal::handle($attributes);
            },
        );
    }
}

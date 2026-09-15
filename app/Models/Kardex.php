<?php

namespace App\Models;

use App\Enums\KardexTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kardex extends Model
{
    protected $fillable = [
        'product_id',
        'product_id',
        'type',
        'quantity',
        'stock_before',
        'stock_after',
        'created_by',
        'user_id',
        'referenceable_id',
        'referenceable_type',
    ];


    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'type' => KardexTypes::class,
        ];
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function referenceable(): MorphTo
    {
        return $this->morphTo();
    }
}

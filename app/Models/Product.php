<?php

namespace App\Models;

use App\Dtos\RelationshipFilter;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Scout\Searchable;
use App\Traits\HasSearchScope;
use Spatie\MediaLibrary\HasMedia;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

/**
 * @method static Builder|QueryBuilder search(string $name)
 * @method static Builder|QueryBuilder searchByName(string $name)
 * @method static Builder|QueryBuilder searchByRelation(RelationshipFilter $data)
 */
#[ObservedBy([ProductObserver::class])]
class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, HasSearchScope, Notifiable, Searchable, InteractsWithMedia;

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
        'active',
        'required_prescription',
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

    public function usages(): BelongsToMany
    {
        return $this->belongsToMany(Usage::class);
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
            get: function () {
                return $this->lastOrderDetails()->value('unit_price');
            }
        );
    }

    public function costPrev(): Attribute
    {
        return Attribute::make(
            get: function () {
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

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'laboratory_id' => $this->laboratory_id,
            'type_id' => $this->type_id,
            'location_id' => $this->location_id,
            'supplier_id' => $this->supplier_id,
            'presentation_id' => $this->presentation_id,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images-product')->useDisk('s3')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(200)->height(200);

        $this->addMediaConversion('preview')->width(600)->height(600);
    }

    public function kardex(): MorphMany
    {
        return $this->morphMany(Kardex::class, 'referenceable');
    }
}

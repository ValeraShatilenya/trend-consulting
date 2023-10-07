<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use TheJano\LaravelFilterable\Traits\HasFilterableTrait;

class Location extends Model
{
    use HasFactory, HasFilterableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'period_start',
        'period_end'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'period_start' => 'datetime',
        'period_end' => 'datetime',
    ];

    /**
     * Get the product.
     * 
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the warehouse.
     * 
     * @return BelongsTo
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get the warehouse.
     * 
     * @param Builder $query
     * @param string  $date
     * 
     * @return Builder
     */
    public function scopeInDate(Builder $query, string $date): Builder
    {
        return $query->where('period_start', '<=', $date)
            ->where(
                fn (Builder $query) =>
                $query->where('period_end', '>=', $date)
                    ->orWhereNull('period_end')
            );
    }
}

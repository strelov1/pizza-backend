<?php

namespace App\Models;

use App\Contract\ProductContainable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model implements ProductContainable
{
    protected $fillable = [
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Product::class, 'order_products', 'order_id', 'product_id');
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(\App\Models\OrderProduct::class, 'order_id');
    }
}
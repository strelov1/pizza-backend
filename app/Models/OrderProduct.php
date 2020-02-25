<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProduct extends Model
{
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
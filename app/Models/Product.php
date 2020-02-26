<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Product
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 */
class Product extends Model
{

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
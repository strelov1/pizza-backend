<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as IlluminateModel;
use Illuminate\Support\Str;

/**
 * Class Model
 * @package App\Models
 */
class Model extends IlluminateModel
{
    public static function tableName(): string
    {
        return Str::snake(Str::pluralStudly(class_basename(static::class)));
    }

}
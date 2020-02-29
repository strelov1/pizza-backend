<?php

namespace App\Models;

/**
 * Class Token
 * @package App\Models
 *
 * @property int $id
 * @property string $token
 */
class Token extends Model
{
    protected $hidden = ['updated_at', 'created_at'];

    protected $fillable = [
        'token',
    ];
}
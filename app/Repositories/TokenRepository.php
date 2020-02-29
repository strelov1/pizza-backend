<?php


namespace App\Repositories;

use App\Models\Token;

class TokenRepository extends Repository
{
    /**
     * Model name.
     *
     * @return mixed|string
     */
    function model(): string
    {
        return Token::class;
    }
}
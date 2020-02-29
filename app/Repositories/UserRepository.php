<?php


namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    /**
     * Model name.
     *
     * @return mixed|string
     */
    function model(): string
    {
        return User::class;
    }
}
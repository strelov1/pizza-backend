<?php


namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends Repository
{
    /**
     * Model name.
     *
     * @return mixed|string
     */
    function model(): string
    {
        return Order::class;
    }
}
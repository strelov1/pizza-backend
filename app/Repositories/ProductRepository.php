<?php


namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends Repository
{
    /**
     * Model name.
     *
     * @return mixed|string
     */
    function model(): string
    {
        return Product::class;
    }
}
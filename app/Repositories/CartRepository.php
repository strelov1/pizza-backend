<?php


namespace App\Repositories;


use Illuminate\Support\Facades\Cache;

class CartRepository
{

    public function save($product_id): void
    {
        $products = Cache::get('products') ?? [];
        Cache::put('products', array_merge([$product_id], $products), 3200);
    }

    public function getProducts()
    {
        return Cache::get('products') ?? [];
    }

    public function getCount(): int
    {
        return count($this->getProducts());
    }
}
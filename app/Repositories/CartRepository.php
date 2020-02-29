<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CartRepository
{
    protected $storage_key = 'product';

    public function save($cartItem): void
    {
        $products = $this->getProducts();

        $collection = collect($products);

        if ($collection->contains('product_id', $cartItem['product_id'])) {
            $collection = $collection->map(function ($product) use ($cartItem) {
                if ($product['product_id'] === $cartItem['product_id']) {
                    $product['count'] += $cartItem['count'];
                }

                return $product;
            });
        } else {
            $collection = $collection->merge([$cartItem]);
        }

        $this->put($collection);
    }

    public function update($cartItem): void
    {
        $products = $this->getProducts();

        $collection = collect($products);

        if ($collection->contains('product_id', $cartItem['product_id'])) {
            $collection = $collection->map(function ($product) use ($cartItem) {
                if ($product['product_id'] === $cartItem['product_id']) {
                    $product['count'] = $cartItem['count'];
                }

                return $product;
            });
        }

        $collection = $collection->filter(function ($product) {
            return 0 !== $product['count'];
        });

        $this->put($collection);
    }

    public function getProducts()
    {
        return $this->get();
    }

    protected function put(Collection $collection)
    {
        Cache::put($this->storage_key, $collection->toJson(), 320);
    }

    protected function get()
    {
        if (Cache::has($this->storage_key)) {
            return json_decode(Cache::get($this->storage_key), true);
        }

        return [];
    }
}

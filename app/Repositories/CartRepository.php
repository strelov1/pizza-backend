<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Class CartRepository.
 */
class CartRepository
{
    protected $storage_key = 'product';

    public function save($cartItem): void
    {
        $products = $this->getProducts($cartItem['token']);

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

        $this->put($collection, $cartItem['token']);
    }

    public function update($cartItem): void
    {
        $products = $this->getProducts($cartItem['token']);

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

        $this->put($collection, $cartItem['token']);
    }

    public function getProducts($token)
    {
        return $this->get($token);
    }

    public function clean($token)
    {
         Cache::forget($this->storage_key.$token);
    }

    private function put(Collection $collection, $token)
    {
        Cache::put($this->storage_key.$token, $collection->toJson(), 7200);
    }

    private function get($token)
    {
        $key = $this->storage_key.$token;
        if (Cache::has($key)) {
            return json_decode(Cache::get($key), true);
        }

        return [];
    }
}

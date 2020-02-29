<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\CartRepository;

class CartService
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function addProduct(int $product_id, int $count): void
    {
        $cartItem = ['product_id' => $product_id, 'count' => $count];
        $this->cartRepository->save($cartItem);
    }

    public function update(int $product_id, int $count): void
    {
        $cartItem = ['product_id' => $product_id, 'count' => $count];
        $this->cartRepository->update($cartItem);
    }

    public function getCount(): int
    {
        return $this->cartRepository->getCount();
    }

    public function getProducts()
    {
        return $this->cartRepository->getProducts();
    }
    public function getProductWithCount()
    {
        $cartProducts = $this->getProducts();
        $productIdx = collect($cartProducts)->pluck('product_id');
        $products = Product::whereIn('id', $productIdx)->get();

        $result = [];
        foreach ($products as $product) {
            foreach ($cartProducts as $cartProduct) {
                if ($product->id === $cartProduct['product_id']) {
                    $result[] = array_merge($product->toArray(), [
                        'count' => $cartProduct['count'],
                        'image' => $product->image->src,
                    ]);
                }
            }
        }

        return $result;
    }
}
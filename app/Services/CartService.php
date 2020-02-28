<?php

namespace App\Services;

use App\Repositories\CartRepository;

class CartService
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function addProduct(int $product_id): void
    {
        $this->cartRepository->save($product_id);
    }

    public function getCount(): int
    {
        return $this->cartRepository->getCount();
    }

    public function getProducts()
    {
        return $this->cartRepository->getProducts();
    }
}
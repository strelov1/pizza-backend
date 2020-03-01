<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

/**
 * Class CartService.
 */
class CartService
{
    protected $cartRepository;
    protected $productRepository;
    protected $token;

    /**
     * CartService constructor.
     *
     * @throws \Exception
     */
    public function __construct(
        Request $request,
        CartRepository $cartRepository,
        ProductRepository $productRepository
    ) {
        if (!$request['token']) {
            throw new \Exception('No token in Request');
        }

        $this->token = $request['token'];
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @param $data
     */
    public function addProduct($data): void
    {
        $this->cartRepository->save($data);
    }

    /**
     * @param $data
     */
    public function update($data): void
    {
        $this->cartRepository->update($data);
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        $count = collect($this->cartRepository->getProducts($this->token))
            ->reduce(function ($carry, $product) {
                return $carry + $product['count'];
            })
        ;
        return $count ?? 0;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->cartRepository->getProducts($this->token);
    }

    /**
     * @return array
     */
    public function getCartBindProduct(): array
    {
        $cartProducts = $this->getProducts();
        if (! $cartProducts) {
            return [];
        }

        $productIdx = collect($cartProducts)->pluck('product_id');
        $products = $this->productRepository->findBy('id', $productIdx)->all();

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

    /**
     * Clean cart
     */
    public function clean()
    {
       $this->cartRepository->clean($this->token);
    }
}

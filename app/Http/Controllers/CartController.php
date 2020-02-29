<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartUpdateRequest;
use App\Http\Resources\CartCollection;
use App\Services\CartService;

class CartController extends Controller
{
    /** @var CartService */
    protected $cartService;

    /**
     * CartController constructor.
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @param CartUpdateRequest $request
     * @return array
     */
    public function add(CartUpdateRequest $request)
    {
        $this->cartService->addProduct($request->all());

        return [
            'count' => $this->cartService->getCount(),
            'products' => $this->cartService->getProducts(),
        ];
    }

    /**
     * @return array
     */
    public function update(CartUpdateRequest $request)
    {
        $productId = (int) $request->post('product_id');
        $count = (int) $request->post('count');

        $this->cartService->update($productId, $count);

        return [
            'count' => $this->cartService->getCount(),
            'products' => $this->cartService->getProducts(),
            'product_id' => $productId,
        ];
    }

    /**
     * @return CartCollection
     */
    public function content()
    {
        return new CartCollection($this->cartService->getProductWithCount());
    }

    /**
     * @return array
     */
    public function count()
    {
        return ['count' => $this->cartService->getCount()];
    }
}

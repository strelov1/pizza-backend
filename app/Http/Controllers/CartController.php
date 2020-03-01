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
     * @return array
     */
    public function add(CartUpdateRequest $request)
    {
        $service = $this->cartService;

        $service->addProduct($request->all());

        return [
            'count' => $service->getCount(),
            'products' => $service->getProducts(),
        ];
    }

    /**
     * @return array
     */
    public function update(CartUpdateRequest $request)
    {
        $service = $this->cartService;

        $service->update($request->all());

        return [
            'count' => $this->cartService->getCount(),
            'products' => $this->cartService->getProducts(),
        ];
    }

    public function content(): CartCollection
    {
        return new CartCollection($this->cartService->getCartBindProduct());
    }

    /**
     * @return array
     */
    public function count()
    {
        return ['count' => $this->cartService->getCount()];
    }
}

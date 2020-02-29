<?php

namespace App\Http\Controllers;

use App\Resources\CartCollection;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /** @var CartService  */
    protected $cartService;

    /**
     * CartController constructor.
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function add(Request $request)
    {
        $productId = (int) $request->post('product_id');
        $count = (int) $request->post('count');

        $this->cartService->addProduct($productId, $count);

        return [
            'count' => $this->cartService->getCount(),
            'products' => $this->cartService->getProducts(),
            'product_id' => $productId
        ];
    }

    public function update(Request $request)
    {
        $productId = (int) $request->post('product_id');
        $count = (int) $request->post('count');

        $this->cartService->update($productId, $count);

        return [
            'count' => $this->cartService->getCount(),
            'products' => $this->cartService->getProducts(),
            'product_id' => $productId
        ];
    }

    public function content()
    {
        return new CartCollection($this->cartService->getProductWithCount());
    }


    public function count()
    {
        return ['count' => $this->cartService->getCount()];
    }
}

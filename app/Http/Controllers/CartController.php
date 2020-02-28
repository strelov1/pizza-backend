<?php

namespace App\Http\Controllers;

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

        $this->cartService->addProduct($productId);

        return [
            'status' => 1,
            'count' => $this->cartService->getCount(),
            'products' => $this->cartService->getProducts(),
            'product_id' => $productId
        ];
    }


    public function count()
    {
        return ['count' => $this->cartService->getCount()];
    }
}

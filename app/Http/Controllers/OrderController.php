<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\CreateOrderResponse;
use App\Http\Resources\LastOrderResponse;
use App\Http\Resources\OrderCollection;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create(CreateOrderRequest $request): CreateOrderResponse
    {
        return new CreateOrderResponse($this->orderService->create($request->all()));
    }

    public function history(): OrderCollection
    {
        return new OrderCollection($this->orderService->history());
    }

    public function last()
    {
        return new LastOrderResponse($this->orderService->lastOrderData());
    }
}

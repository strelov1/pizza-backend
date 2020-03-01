<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;

class OrderService
{
    protected $cartService;
    protected $userRepository;
    protected $orderRepository;

    public function __construct(
        CartService $cartService,
        UserRepository $userRepository,
        OrderRepository $orderRepository
    ) {
        $this->cartService = $cartService;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param $data
     * @return int[]
     * @throws \Exception
     */
    public function create(array $data)
    {
        $cartData = $this->cartService->getProducts();

        if (!$cartData) {
            throw new \Exception('Cart is empty');
        }

        /** @var User $user */
        $user = $this->userRepository->findBy('token', $data['token']);

        if (!$user) {
            $user = $this->userRepository->create($data);
        }

        $order = $this->orderRepository->create(array_merge($data, [
            'user_id' => $user->id
        ]));

        foreach ($cartData as $product) {
            $order->products()->attach(
                $product['product_id'],
                ['count' => $product['count']]
            );
        }

        // Clean card
        $this->cartService->clean();

        return ['status' => 1, 'order_id' => $order->id];
    }
}

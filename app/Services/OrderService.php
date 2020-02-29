<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;

class OrderService
{
    protected $cartRepository;
    protected $userRepository;
    protected $orderRepository;

    public function __construct(
        CartRepository $cartRepository,
        UserRepository $userRepository,
        OrderRepository $orderRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
    }

    public function save($data): void
    {
        /** @var User $user */
        $user = $this->userRepository->findBy('phone', '7234234324234');
        if (! $user) {
            $user = $this->userRepository->create([
                'name' => 'hi',
                'phone' => '7234234324234'
            ]);
        }

        $order = $this->orderRepository->create([
            'user_id' => $user->id,
        ]);

//        $order->products()->attach(
//           1, ['count' => 1]
//        );

        foreach ($this->cartRepository->getProducts() as $product) {
            $order->products()->attach(
                $product['product_id'],
                ['count' => $product['count']]
            );
        }
    }
}
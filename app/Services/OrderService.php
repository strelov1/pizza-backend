<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class OrderService
{
    protected $cartService;
    protected $userRepository;
    protected $orderRepository;
    protected $token;

    public function __construct(
        Request $request,
        CartService $cartService,
        UserRepository $userRepository,
        OrderRepository $orderRepository
    ) {

        if (!$request['token']) {
            throw new \Exception('No token in Request');
        }

        $this->token = $request['token'];

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
        $cartData = $this->cartService->getCartBindProduct();

        if (!$cartData) {
            throw new \Exception('Cart is empty');
        }

        /** @var User $user */
        $user = $this->userRepository->findBy('token', $this->token);

        if (!$user) {
            $user = $this->userRepository->create($data);
        }

        $order = $this->orderRepository->create(array_merge($data, [
            'user_id' => $user->id
        ]));

        foreach ($cartData as $product) {
            $order->products()->attach(
                $product['id'],
                [
                    'count' => $product['count'],
                    'price_usd' => $product['price_usd'],
                    'price_eur' => $product['price_eur'],
                ]
            );
        }

        // Clean card
        $this->cartService->clean();

        return ['status' => 1, 'order_id' => $order->id];
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function history()
    {
        $user = $this->user();

        return $user->orders ?? [];
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function lastOrderData(): array
    {
        try {
            $user = $this->user();
        } catch (\Exception $e) {
            return [];
        }

        $lastOrder = $this->orderRepository->findBy('user_id', $user->id);

        if ($lastOrder) {
            return array_merge([
                'name' => $user->name,
                'phone' => $user->phone,
            ], $lastOrder->toArray());
        }

        return [];
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    private function user()
    {
        $user = $this->userRepository->findBy('token', $this->token);

        if (!$user) {
            throw new \Exception('User not exist');
        }

        return $user;
    }
}

<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LastOrderResponse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'status' => 1,
            'data' => [
                'name' => $this['name'] ?? null,
                'phone' => $this['phone'] ?? null,
                'street' => $this['street'] ?? null,
                'house' => $this['house'] ?? null,
                'flat' => $this['flat'] ?? null,
                'flour' => $this['flour'] ?? null,
                'payment_way' => $this['payment_way'] ?? null,
            ]
        ];
    }
}
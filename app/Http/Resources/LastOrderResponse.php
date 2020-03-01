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
                'name' => $this['name'],
                'phone' => $this['phone'],
                'street' => $this['street'],
                'house' => $this['house'],
                'flat' => $this['flat'],
                'flour' => $this['flour'],
                'payment_way' => $this['payment_way'],
            ]
        ];
    }
}
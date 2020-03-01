<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreateOrderResponse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'status' => $this['status'],
            'data' => [
                'order_id' => $this['order_id']
            ]
        ];
    }
}
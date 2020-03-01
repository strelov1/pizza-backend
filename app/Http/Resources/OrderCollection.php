<?php


namespace App\Http\Resources;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    public function toArray($response)
    {
        /** @var Order $item */
        return $this->resource->map(function ($item) {
            return [
                'id' => $item->id,
                'created_at' => Carbon::parse($item->created_at)->format('Y-m-d'),
                'address' => "{$item->street} {$item->house} {$item->flat} {$item->flour}",
                'payment_way' => $item->payment_way,
                'delivery_time' => $item->delivery_time,
                'products' => new OrderProductCollection($item->orderProducts),
            ];
        });
    }
}
<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderProductCollection extends ResourceCollection
{
    public function toArray($response)
    {
        return $this->resource->map(function ($item) {
            return [
                'count' => $item->count,
                'name' => $item->product->name,
                'image' => $item->product->image->src,
                'description' => $item->product->description,
                'price' => [
                    'usd' => $item->price_usd,
                    'eur' => $item->price_eur,
                ],
            ];
        });
    }
}
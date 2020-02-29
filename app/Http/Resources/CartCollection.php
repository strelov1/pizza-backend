<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends ResourceCollection
{
    public function toArray($response)
    {
        return $this->resource->map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'description' => $item['description'],
                'count' => $item['count'],
                'image' => $item['image'],
                'price' => [
                    'usd' => $item['price_usd'],
                    'eur' => $item['price_eur'],
                ],
            ];
        });
    }
}
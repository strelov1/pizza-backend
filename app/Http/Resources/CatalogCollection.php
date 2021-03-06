<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CatalogCollection extends ResourceCollection
{
    public function toArray($response)
    {
        return $this->resource->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'image' => $item->image->src,
                'description' => $item->description,
                'price' => [
                    'usd' => $item->price_usd,
                    'eur' => $item->price_eur,
                ],
            ];
        });
    }
}
<?php


namespace App\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CatalogCollection extends ResourceCollection
{
    public function toArray($response)
    {
        return $this->resource->map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item->name,
                'image' => $item->image->src,
            ];
        });
    }
}
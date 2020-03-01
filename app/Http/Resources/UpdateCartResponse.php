<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UpdateCartResponse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'status' => 1,
            'data' => [
                'count' => $this['count'],
                'products' => $this['products'],
            ],
        ];
    }
}
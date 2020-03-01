<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResponse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'status' => $this['status'],
        ];
    }
}
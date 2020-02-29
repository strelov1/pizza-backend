<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TokenResponse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'token' => $this->token
            ],
            'status' => 1,
        ];
    }
}
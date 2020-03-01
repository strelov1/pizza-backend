<?php


namespace App\Http\Requests;

class CreateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|string',
            'street' => 'required|string',
            'house' => 'string',
            'flat' => 'string',
            'flour' => 'string',
            'delivery_time' => 'required|string',
            'payment_way' => 'required|string',
            'comment' => 'string',
        ];
    }
}
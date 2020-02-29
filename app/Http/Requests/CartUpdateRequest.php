<?php


namespace App\Http\Requests;

class CartUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer',
            'count' => 'required|integer',
        ];
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $count = Cache::get('count') ?? 0;
        Cache::increment('count');
        return [
            'status' => 1,
            'count' => $count,
            'product_id' => $request->post('product_id')
        ];
    }


    public function count(Request $request)
    {
        $count = Cache::get('count') ?? 0;
        return ['count' => $count];
    }
}

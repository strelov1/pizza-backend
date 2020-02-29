<?php

namespace App\Http\Controllers;

use App\Http\Resources\CatalogCollection;
use App\Models\Product;

class CatalogController extends Controller
{
    public function index()
    {
        return new CatalogCollection(Product::all());
    }
}

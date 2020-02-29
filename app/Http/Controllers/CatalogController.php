<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Resources\CatalogCollection;

class CatalogController extends Controller
{
    public function index()
    {
        return new CatalogCollection(Product::all());
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\CatalogCollection;
use App\Repositories\ProductRepository;

class CatalogController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return new CatalogCollection($this->productRepository->all());
    }
}

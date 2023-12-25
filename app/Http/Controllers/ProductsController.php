<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductsRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function __construct(private ProductService $productService)
    {
        $this->productService = $productService;

    }

    public function index(ProductsRequest $productsRequest): Factory
    {
        if(Auth::check())
        {
        
            return view('index', []);
        }

        return redirect()->back();
    }
    public function show(ProductsRequest $productsRequest): Factory
    {
        if(Auth::check())
        {

            return view('index', []);
        }

        return redirect()->back();
    }

}

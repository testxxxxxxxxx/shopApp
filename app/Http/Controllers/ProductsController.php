<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\IdRequest;
use App\Http\Requests\ProductsRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class ProductsController extends Controller
{
    public function __construct(private ProductService $productService)
    {
        $this->productService = $productService;

    }

    public function index(): View
    {
        
        return view('index', []);
    }
    public function show(IdRequest $idRequest): View
    {
        $name = $this->productService->getName((int)$idRequest->input('id'));
        $price = $this->productService->getPrice((int)$idRequest['id']);
        $weight = $this->productService->getWeight((int)$idRequest['id']);
        $count = $this->productService->getCount((int)$idRequest['id']);
        $categoryId = $this->productService->getCategoryId((int)$idRequest['id']); 

        return view('index', ['name' => $name, 'price' => $price, 'weight' => $weight, 'count' => $count, 'categoryId' => $categoryId]);
    }
    public function create(ProductsRequest $productsRequest): RedirectResponse
    {
        if(Auth::check())
        {
            $name = $productsRequest->input('name');
            $price = $productsRequest['price'];
            $weight = $productsRequest['weight'];
            $count = $productsRequest['count'];
            $categoryId = $productsRequest['category_id'];

            $productIsCreated = $this->productService->create((string)$name, (float)$price, (float)$weight, (int)$count, (int)$categoryId);

            if($productIsCreated)
                return redirect()->route('showProduct', ['name' => $name, 'price' => $price, 'weight' => $weight, 'count' => $count, 'categoryId' => $categoryId]);

            return redirect()->back();

        }

        return redirect()->back();

    }
    public function update(IdRequest $idRequest, ProductsRequest $productsRequest): RedirectResponse 
    {
        if(Auth::check())
        {
            $id = $idRequest->input('id');
            $name = $productsRequest['name'];
            $price = $productsRequest['price'];
            $weight = $productsRequest['weight'];
            $count = $productsRequest['count'];
            $categoryId = $productsRequest['category_id'];

            $productIsUpdated = $this->productService->update((int)$id, (float)$name, (float)$weight, (int)$count, (int)$categoryId);

            if($productIsUpdated)
                return redirect()->route('showProduct', ['name' => $name, 'price' => $price, 'weight' => $weight, 'categoryId' => $categoryId]);

            return redirect()->back();
        }

        return redirect()->back();
    }
    public function delete(IdRequest $idRequest): RedirectResponse
    {
        if(Auth::check())
        {
            $id = $idRequest->input('id');

            $productIsDeleted = $this->productService->delete((int)$id);

            if($productIsDeleted)
                return redirect()->route('showProduct');

            return redirect()->back();
        }

        return redirect()->back();
    }

}

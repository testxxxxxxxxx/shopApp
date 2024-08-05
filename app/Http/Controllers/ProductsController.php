<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\ImageService;
use App\Services\ImageCRUDService;
use App\Services\FileContentGetter;
use App\Http\Requests\IdRequest;
use App\Http\Requests\ProductsRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;

class ProductsController extends Controller
{
    public function __construct(private ProductService $productService, private ImageService $imageService, private ImageCRUDService $imageCRUDService, private FileContentGetter $fileContentGetter)
    {
        $this->productService = $productService;
        $this->imageService = $imageService;
        $this->imageCRUDService = $imageCRUDService;
        $this->fileContentGetter = $fileContentGetter;

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
        $imageId = $this->productService->getImageId((int)$idRequest['image_id']);

        $file = $this->imageService->getFile($imageId);

        return view('index', ['name' => $name, 'price' => $price, 'weight' => $weight, 'count' => $count, 'categoryId' => $categoryId, 'file' => $file]);
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

            $file = $productsRequest->file('image');

            $fileName = $file->getFilename();
            $fileExt = $file->getExtension();
            $fileTmpUrl = $file->getPathname();
            $fileSize = $file->getSize();
            $fileMaxSize = 12000;

            if($fileName < 0 || $fileName > $fileMaxSize)
                return redirect()->back();

            try{

                $fileContent = $this->fileContentGetter->getContent($fileTmpUrl);

                $imageId = $this->imageCRUDService->create($fileName, $fileExt, $fileContent, $fileSize);

                $this->productService->create((string)$name, (float)$price, (float)$weight, (int)$count, (int)$categoryId, (int)$imageId);

                return redirect()->route('showProduct', ['name' => $name, 'price' => $price, 'weight' => $weight, 'count' => $count, 'categoryId' => $categoryId]);
            }
            catch(QueryException $e)
            {

                return redirect()->back();
            }
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
            $imageId = $productsRequest['image_id'];

            $productIsUpdated = $this->productService->update((int)$id, (float)$name, (float)$weight, (int)$count, (int)$categoryId, (int)$imageId);

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

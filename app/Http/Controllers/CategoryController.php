<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\IdRequest;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

    }

    public function index(): Factory | RedirectResponse | View
    {
        if(Auth::check())
        {

            return view('index', []);
        }

        return redirect()->back();
    }
    public function show(IdRequest $idRequest): Factory | RedirectResponse | View
    {
        if(Auth::check())
        {
            $categoryId = $idRequest->input('id');

            $categoryName = $this->categoryService->getName($categoryId);

            return view('index', ['categoryName' => $categoryName]);
        }

        return redirect()->back();

    }
    public function create(CategoryRequest $categoryRequest): RedirectResponse
    {
        if(Auth::check())
        {
            $categoryName = $categoryRequest['name'];

            $categoryIsCreated = $this->categoryService->create($categoryName);

            if($categoryIsCreated > 0)
                return redirect()->route('showCategory', ['id' => $categoryIsCreated]);

            return redirect()->back();
       }
       

       return redirect()->back();
    }
    public function update(IdRequest $idRequest, CategoryRequest $categoryRequest): RedirectResponse
    {
        if(Auth::check())
        {
            $categoryId = $idRequest->input('id');
            $categoryName = $categoryRequest['name'];

            $categoryIsUpdated = $this->categoryService->update($categoryId, $categoryName);

            if($categoryIsUpdated)
                return redirect()->route('showCategory', ['id' => $categoryIsUpdated]);

            return redirect()->back();
        }

        return redirect()->back();

    }
    public function delete(IdRequest $idRequest): RedirectResponse
    {
        if(Auth::check())
        {
            $categoryId = $idRequest->input('id');

            $categoryIsDeleted = $this->categoryService->delete($categoryId);

            if($categoryIsDeleted)
                return redirect()->route('showCategories');

            return redirect()->back();
        }

        return redirect()->back();
    }

}

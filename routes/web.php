<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::domain('localhost')->group(function(){

    Route::middleware('auth')->group(function(){

        Route::get('/showProducts', [ProductsController::class, 'index'])->name('showProducts');
        Route::get('/showProduct/{id}', [ProductsController::class, 'show'])->where('id', '[0-9]*')->name('showProduct');
        Route::post('/createProduct', [ProductsController::class, 'create'])->name('createProduct');
        Route::post('/updateProduct', [ProductsController::class, 'update'])->name('updateProduct');
        Route::post('/deleteProduct', [ProductsController::class, 'delete'])->name('deleteProduct');
        Route::get('/showCategories', [CategoryController::class, 'index'])->name('showCategories');
        Route::get('/showCategory/{id}', [CategoryController::class, 'show'])->where('id', '[0-9]*')->name('showCategory');
        Route::post('/createCategory', [CategoryController::class, 'create'])->name('createCategory');
        Route::post('/updateCategory', [CategoryController::class, 'update'])->name('updateCategory');
        Route::post('/deleteCategory', [CategoryController::class, 'delete'])->name('deleteCategory');
        Route::get('/showOrders', [OrderController::class, 'index'])->name('showOrders');
        Route::get('/showOrder/{id}', [OrderController::class, 'show'])->where('id', '[0-9]*')->name('showOrder');
        Route::post('/createOrder', [OrderController::class, 'create'])->name('createOrder');
        Route::post('/updateOrder', [OrderController::class, 'update'])->name('updateOrder');
        Route::post('/deleteOrder', [OrderController::class, 'delete'])->name('deleteOrder');

    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

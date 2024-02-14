<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductsController;

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
        Route::get('/showProduct/{id}', [ProductsController::class, 'show'])->name('showProduct');
        Route::post('/createProduct', [ProductsController::class, 'create'])->name('createProduct');
        Route::post('/updateProduct', [ProductsController::class, 'update'])->name('updateProduct');
        Route::delete('/deleteProduct', [ProductsController::class, 'delete'])->name('deleteProduct');

    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\ProductService;
use App\Services\CategoryService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductService::class,function($app){

            return new ProductService(i: 0);
        });

        $this->app->bind(CategoryService::class,function($app){

            return new CategoryService(id: 0);
        });
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(255);
        
    }
}

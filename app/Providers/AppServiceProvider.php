<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\OrderService;
use App\Services\TimeService;
use App\Services\PersonalDataUserService;
use App\Services\OrderValidator;
use \DateTime;

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

        $this->app->bind(OrderService::class,function($app){

            return new OrderService(id: 0);
        });

        $this->app->bind(TimeService::class,function($app){

            return new TimeService($app->make(DateTime::class));
        });

        $this->app->bind(PersonalDataUserService::class,function($app){

            return new PersonalDataUserService();
        });

        $this->app->bind(OrderValidator::class,function($app){

            return new OrderValidator($app->make(ProductService::class));
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

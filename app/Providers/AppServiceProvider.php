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
use App\Services\ImageService;
use App\Services\ImageCRUDService;
use \DateTime;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductService::class,function($app){

            return new ProductService();
        });

        $this->app->bind(CategoryService::class,function($app){

            return new CategoryService();
        });

        $this->app->bind(OrderService::class,function($app){

            return new OrderService();
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

        $this->app->bind(ImageService::class,function($app){

            return new ImageService();
        });

        $this->app->bind(ImageCRUDService::class,function($app){

            return new ImageCRUDService();
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

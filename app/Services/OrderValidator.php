<?php

declare(strict_types = 1);

namespace App\Services;

use App\Services\ProductService;

class OrderValidator
{
    public function __construct(private ProductService $productService)
    {
        $this->productService = $productService;

    }

    public function isNonEmpty(): bool
    {
        
        return false;
    }

}
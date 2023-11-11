<?php

declare(strict_types = 1);

namespace App\Services;

class ProductService
{
    protected int $id;

    public function __construct(private int $i)
    {
        $this->id = $i;
        
    }

}
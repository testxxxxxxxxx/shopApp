<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    protected int $id;

    public function __construct(private int $i)
    {
        $this->id = $i;
        
    }

    public function getName(int $id): string
    {
        $name = Product::query()->find($id)->get('name');

        return $name[0]['name'];
    }
    public function getPrice(int $id): float
    {
        $price = Product::query()->find($id)->get('price');

        return $price[0]['price'];
    }
    public function getWeight(int $id): float
    {
        $weight = Product::query()->find($id)->get('weight');

        return $weight[0]['price'];
    }

}
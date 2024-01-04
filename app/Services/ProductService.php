<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
    public function create(float $price, float $weight, int $categoryId): Model
    {
        $productIsCreated = Product::query()->create([

            'price' => $price,
            'weight' => $weight,
            'category_id' => $categoryId,

        ]);

        return $productIsCreated;
    }
    public function update(int $id, float $price, float $weight, int $categoryId): int
    {
        $productIsUpdated = Product::query()->where('id', $id)->update(['price' => $price, 'weight' => $weight, 'category_id' => $categoryId]);

        return $productIsUpdated;
    }
    public function delete(int $id): int
    {
        $productIsDeleted = Product::query()->where('id', $id)->delete();

        return $productIsDeleted;
    }

}
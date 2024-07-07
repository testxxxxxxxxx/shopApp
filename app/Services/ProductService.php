<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    public function getName(int $id): string | bool
    {
        $product = Product::query()->find($id);

        if($product->name)
            return false;

        return $product->name;
    }
    public function getPrice(int $id): float | bool
    {
        $product = Product::query()->find($id);

        if(!$product->price)
            return false;

        return $product->price;
    }
    public function getWeight(int $id): float | bool
    {
        $product = Product::query()->find($id);

        if(!$product->weight)
            return false;

        return $product->weight;
    }
    public function getCategoryId(int $id): int | bool
    {
        $product = Product::query()->find($id);

        if(!$product->category_id)
            return false;

        return $product->category_id;
    }
    public function getCount(int $id): int | bool
    {
        $product = Product::query()->find($id);

        if(!$product->count)
            return false;

        return $product->count;
    }
    public function create(string $name, float $price, float $weight, int $count, int $categoryId): Model
    {
        $productIsCreated = Product::query()->create([

            'name' => $name,
            'price' => $price,
            'weight' => $weight,
            'count' => $count,
            'category_id' => $categoryId,

        ]);

        return $productIsCreated;
    }
    public function update(int $id, float $price, float $weight, int $count, int $categoryId): int
    {
        $productIsUpdated = Product::query()->where('id', $id)->update(['price' => $price, 'weight' => $weight, 'count' => $count, 'category_id' => $categoryId]);

        return $productIsUpdated;
    }
    public function delete(int $id): int
    {
        $productIsDeleted = Product::query()->where('id', $id)->delete();

        return $productIsDeleted;
    }

}
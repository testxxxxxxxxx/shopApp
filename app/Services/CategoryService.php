<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryService
{
    public function getName(int $id): string | bool
    {
        $product = Category::query()->find($id);

        if($product->name)
            return false;

        return $product->name;
    }
    public function create(string $name): int
    {
        $categoryIsCreated = Category::query()->insertGetId([

            'name' => $name,

        ]);

        return $categoryIsCreated;
    }
    public function update(int $id, string $name): int
    {
        $categoryIsUpdated = Category::query()->where('id', $id)->update(['name' => $name]);

        return $categoryIsUpdated;
    }
    public function delete(int $id): int
    {
        $categoryIsDeleted = Category::query()->where('id', $id)->delete();

        return $categoryIsDeleted;
    }

}
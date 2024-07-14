<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Image;

class ImageCRUDService
{
    public function create(string $name, string $extension, string $file, int $size): int | bool
    {
        $image = Image::query()->insertGetId([

            'name' => $name,
            'extension' => $extension,
            'file' => $file,
            'size' => $size

        ]);

        return $image;
    }
    public function update(int $id, string $name, string $extension, string $file, int $size): int 
    {
        $image = Image::query()->where('id', $id)->update(['name' => $name, 'extension' => $extension, 'file' => $file, 'size' => $size]);

        return $image;
    }
    public function delete(int $id): bool 
    {
        $image = Image::query()->where('id', $id)->delete();

        return $image;
    }

}
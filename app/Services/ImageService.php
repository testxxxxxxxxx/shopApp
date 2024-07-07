<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Image;

class ImageService
{
    public function getName(int $id): string | bool
    {
        $image = Image::query()->find($id);

        if(!$image->name)
            return false;

        return $image->name;
    }
    public function getExtension(int $id): string | bool 
    {
        $image = Image::query()->find($id);

        if($image->extension)
            return false;

        return $image->extension;
    }
    public function getFile(int $id): string | bool 
    {
        $image = Image::query()->find($id);

        if(!$image->file)
            return false;

        return $image->file;
    }
    public function getSize(int $id): string | bool
    {
        $image = Image::query()->find($id);

        if(!$image->size)
            return false;

        return $image->size;
    }

}
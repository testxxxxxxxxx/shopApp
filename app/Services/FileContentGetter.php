<?php

declare(strict_types = 1);

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileContentGetter
{
    public function getContent(string $path): string 
    {

        return Storage::get($path);
    }

}
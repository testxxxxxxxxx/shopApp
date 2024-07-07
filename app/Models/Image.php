<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [

        'name',
        'extension',
        'file'

    ];

    public function products(): HasMany
    {

        return $this->hasMany(Product::class);
    }

}

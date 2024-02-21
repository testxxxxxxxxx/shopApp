<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [

        'name',
        'price',
        'weight',
        'category_id',

    ];

    public function categoryId(): BelongsTo
    {

        return $this->belongsTo(Category::class);
    }

}

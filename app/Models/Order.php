<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [

        'product_id',
        'date',
        'from',
        'to',

    ];

    public function productId(): BelongsTo
    {

        return $this->belongsTo(Product::class);
    }
    public function from(): BelongsTo
    {

        return $this->belongsTo(User::class);
    }
    public function toCustomer(): BelongsTo
    {

        return $this->belongsTo(User::class);
    }

}

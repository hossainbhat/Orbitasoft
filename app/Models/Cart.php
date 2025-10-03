<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'size',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

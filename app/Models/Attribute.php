<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'attribute_product')
                    ->withPivot('value')
                    ->withTimestamps();
    }

    public function attributeValue()
    {
        return $this->hasMany(AttributeValue::class,'attribute_id','id');
    }
}

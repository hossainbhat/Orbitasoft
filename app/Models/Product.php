<?php

namespace App\Models;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product')
                    ->withPivot('value')
                    ->withTimestamps();
    }
}

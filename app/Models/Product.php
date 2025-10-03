<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','price','discount','description','category_id','slug'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product')
                    ->withPivot('value')
                    ->withTimestamps();
    }
}

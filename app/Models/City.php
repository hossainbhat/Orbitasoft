<?php

namespace App\Models;

use App\Models\Country;
use App\Models\DeliveryInfo;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function deliveryInfos()
    {
        return $this->hasMany(DeliveryInfo::class);
    }
}

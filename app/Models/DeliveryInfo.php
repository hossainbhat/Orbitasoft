<?php

namespace App\Models;

use App\Models\City;
use App\Models\User;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;

class DeliveryInfo extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'email',
        'address_line1',
        'address_line2',
        'country_id',
        'city_id',
        'state',
        'postal_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

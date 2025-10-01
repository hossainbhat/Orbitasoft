<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItem;
use App\Models\DeliveryInfo;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'delivery_info_id',
        'subtotal',
        'discount',
        'tax',
        'total',
        'status',
        'payment_method',
        'transaction_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deliveryInfo()
    {
        return $this->belongsTo(DeliveryInfo::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

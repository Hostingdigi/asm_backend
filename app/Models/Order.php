<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\Auth\Models\User;

class Order extends Model
{
    protected $fillable = [
        'order_no',
        'user_id',
        'payment_id',
        'total_amount',
        'tax_amount',
        'amount',
        'shipping_amount',
        'coupon_amount',
        'coupon_code',
        'billing_details',
        'shipping_details',
        'ordered_at',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

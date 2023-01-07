<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\Auth\Models\User;

class Order extends Model
{
    protected $fillable = [
        'is_dummy_order',
        'order_no',
        'payment_mode',
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
        'payment_status',
        'preferred_delivery_date',
        'delivery_slot',
        'delivery_instructions',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class,'status','status_code');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class,'order_id');
    }
}

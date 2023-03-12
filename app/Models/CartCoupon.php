<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartCoupon extends Model
{
    protected $fillable = [
        'user_id', 'coupon_id', 'status'
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class,'coupon_id');
    }
}

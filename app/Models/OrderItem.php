<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'quantity',
        'price',
        'total_price',
        'product_details',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingDistAmounts extends Model
{
    protected $table = 'shipping_dist_amounts';
    protected $fillable = ['from_distance', 'to_distance', 'amount', 'status'];

    public function scopeActiveOnly($query)
    {
        return $query->where('status', '1')->orderBy('from_distance')->get();
    }

    public function scopeBothInActive($query)
    {
        return $query->where('status', '!=', '2')->orderBy('from_distance')->get();
    }
}

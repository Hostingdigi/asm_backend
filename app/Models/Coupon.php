<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['coupon_type','vendor_customization','title','code','image','offer_value','start_date','end_date',
        'description','status'];

    public function scopeActiveOnly($query)
    {
        return $query->where('status','1')->latest()->get();
    }

    public function scopeBothInActive($query)
    {
        return $query->where('status','!=','2')->get();
    }

    public function getFormatedImageUrlAttribute()
    {
        return !empty($this->image) ? asset('storage/'.$this->image) : '';
    }
}

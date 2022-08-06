<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['name', 'price', 'unit_id', 'product_id', 'status'];

    public function scopeActiveOnly($query)
    {
        return $query->where('status','1')->orderBy('name')->get();
    }

    public function scopeBothInActive($query)
    {
        return $query->where('status','!=','2')->orderBy('name')->get();
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

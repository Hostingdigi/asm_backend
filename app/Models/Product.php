<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id','category_id','brand_id','code','name', 'cover_image', 'unit', 'price', 'status','description'];

    public function scopeActiveOnly($query)
    {
        return $query->where('status','1')->orderBy('name')->get();
    }

    public function scopeBothInActive($query)
    {
        return $query->where('status','!=','2')->orderBy('name')->get();
    }
}

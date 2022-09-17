<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id','file_name','display_order'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFormatedImageUrlAttribute()
    {
        return !empty($this->file_name) ? asset('storage/'.$this->file_name) : '';
    }
}

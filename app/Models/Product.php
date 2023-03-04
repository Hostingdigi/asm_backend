<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\Auth\Models\User;
use App\Models\Category;
use App\Models\Brand;

class Product extends Model
{
    protected $fillable = ['user_id','category_id','brand_id','code','name', 'is_cutoptions_required', 'cover_image', 'unit', 'price', 'sorting', 'status','description'];

    public function scopeActiveOnly($query)
    {
        return $query->where('status','1')->orderBy('name')->get();
    }

    public function scopeBothInActive($query)
    {
        return $query->where('status','!=','2')->orderBy('name')->get();
    }

    public function getFormatedCoverImageUrlAttribute()
    {
        return !empty($this->cover_image) ? asset('storage/'.$this->cover_image) : '';
    }

    public function supplier()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class)->where('id','!=',null);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}

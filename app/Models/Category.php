<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','parent_id','status','image','banner_image','description'];

    public function scopeActiveOnly($query)
    {
        return $query->where('status','1')->orderBy('name')->get();
    }

    public function scopeBothInActive($query)
    {
        return $query->where('status','!=','2')->orderBy('name')->get();
    }

    public function getFormatedImageUrlAttribute()
    {
        return !empty($this->image) ? asset('storage/'.$this->image) : '';
    }

    public function getFormatedBannerImageUrlAttribute()
    {
        return !empty($this->banner_image) ? asset('storage/'.$this->banner_image) : '';
    }

}

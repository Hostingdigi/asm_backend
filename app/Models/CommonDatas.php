<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonDatas extends Model
{
    protected $fillable = ["key","value_1","value_2","value_3","value_4","value_5","status"];
    
    public function scopeActiveOnly($query)
    {
        return $query->where('status', '1')->get();
    }

    public function scopeBothInActive($query)
    {
        return $query->where('status', '!=', '2')->get();
    }
}

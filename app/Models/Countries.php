<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeActiveOnly($query)
    {
        return $query->where('status','1')->orderBy('name')->get();
    }
}

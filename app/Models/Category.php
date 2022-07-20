<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function scopeActiveOnly($query)
    {
        return $query->where('status', '1')->orderBy('name');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name', 'description', 'status'];

    public function scopeActiveOnly($query)
    {
        return $query->where('status','1')->orderBy('name')->get();
    }

    public function scopeBothInActive($query)
    {
        return $query->where('status','!=','2')->orderBy('name')->get();
    }
}

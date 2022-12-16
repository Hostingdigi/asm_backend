<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';
    protected $fillable = ['status_code','label','description','status','sort_by'];

    public function scopeActiveOnly($query)
    {
        return $query->where('status','1')->orderBy('sort_by')->get();
    }
}

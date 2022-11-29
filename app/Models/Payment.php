<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Payment extends Model
{
    protected $fillable = ['order_type', 'order_id', 'status', 'row_status', 'sent_response', 'payment_response'];

    public function getCreatedAtAttribute($value)
    {
        return !empty($value) ? \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s') : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return !empty($value) ? \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s') : null;
    }
}

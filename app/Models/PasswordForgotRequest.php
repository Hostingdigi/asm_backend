<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordForgotRequest extends Model
{
    protected $fillable = ['user_id','otp','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

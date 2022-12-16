<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralUsers extends Model
{
    protected $table = 'referral_users';
    protected $fillable = ['child_user','parent_user','parent_user_discount','child_user_discount','min_spend_value','status'];
}

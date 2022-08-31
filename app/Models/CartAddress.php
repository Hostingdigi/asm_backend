<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartAddress extends Model
{
    protected $table = "cart_address";
    protected $fillable = ["user_id","name","email_address","mobile","address_type","address","city","state","zipcode","country_id"];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartAddress extends Model
{
    protected $table = "cart_address";
    protected $fillable = ["user_id", "address_type_label", "name", "email_address", "mobile", "address_type", "address", "city", "state", "zipcode", "country_id",
        "latitude", "longitude", "formatted_address", "place_id", "distance", "warehouse_updated_at"];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeActiveOnly($query)
    {
        return $query->where('status', '1')->latest()->get();
    }

    public function addressFields()
    {
        return ["user_id", "address_type_label", "name", "email_address", "mobile", "address_type", "address", "city", "state", "zipcode", "country_id",
            "latitude", "longitude", "formatted_address", "place_id"];
    }

    public function getLatitudeAttribute($value)
    {
        return !empty($value) ? (float) $value : null;
    }

    public function getLongitudeAttribute($value)
    {
        return !empty($value) ? (float) $value : null;
    }
}

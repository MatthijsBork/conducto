<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function properties()
    {
        return $this->hasMany(CarProperty::class);
    }

    public static function getAllProperties()
    {
        return Property::all();
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

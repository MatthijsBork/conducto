<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(HouseImage::class);
    }

    public function responses()
    {
        return $this->hasMany(HouseResponse::class);
    }

    public function acceptedResponse()
    {
        return $this->responses()->where('status', '=', 1)->first();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public function value($car_id)
    {
        $carProperty = CarProperty::where('car_id', $car_id)
            ->where('property_id', $this->id)
            ->first();

        return $carProperty ? $carProperty->value : null;
    }

}

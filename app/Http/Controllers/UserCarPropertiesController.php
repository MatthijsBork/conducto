<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Property;
use App\Models\CarProperty;
use Illuminate\Http\Request;

class UserCarPropertiesController extends Controller
{
    public function show(Request $request, Car $car)
    {
        $this->authorize('hasCar', [Car::class, $car]);

        return view('cars.user.properties', compact('car'));
    }

    public function edit(Request $request, Car $car)
    {
        $this->authorize('hasCar', [Car::class, $car]);

        $properties = Property::orderBy('name')->get();
        return view('cars.user.editProperties', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $this->authorize('hasCar', [Car::class, $car]);

        $car_properties = $car->properties();

        if ($properties = $request->input('properties')) {
            foreach ($properties as $propertyId => $value) {
                $property = $car->properties->first(function ($property) use ($propertyId) {
                    return $property->property_id === $propertyId;
                });

                if ($property) {
                    $value == null ? $property->delete() :
                        $property->value = $value;
                    $property->save();
                } elseif ($value) {
                    $car_property = new CarProperty();
                    $car_property->property_id = $propertyId;
                    $car_property->car_id = $car->id;
                    $car_property->value = $value;
                    $car_property->save();
                }
            }
        }
        return redirect()->route('user.cars.properties', compact('car'))->with('success', 'Eigenschap bijgewerkt');
    }
}

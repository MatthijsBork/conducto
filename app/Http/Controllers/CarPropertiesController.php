<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Property;
use App\Models\CarProperty;
use Illuminate\Http\Request;

class CarPropertiesController extends Controller
{
    public function edit(Request $request, Car $car)
    {
        $properties = Property::orderBy('name')->get();
        return view('cars.editProperties', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $car_properties = $car->properties();

        if ($properties = $request->input('properties')) {
            foreach ($properties as $propertyId => $value) {
                $property = $car->properties->first(function ($property) use ($propertyId) {
                    return $property->property_id === $propertyId;
                });

                if ($property) {
                    $value == null ? $property->delete() :
                        $property->update([
                            'value' => $value,
                        ]);
                } elseif ($value) {
                    $car_property = new CarProperty();
                    $car_property->property_id = $propertyId;
                    $car_property->car_id = $car->id;
                    $car_property->value = $value;
                    $car_property->save();
                }
            }
        }
        return redirect()->route('dashboard.cars.properties', compact('car'))->with('success', 'Eigenschap bijgewerkt');
    }
}

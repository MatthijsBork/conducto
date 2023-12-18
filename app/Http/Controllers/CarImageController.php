<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\CarImageStoreRequest;
use App\Models\CarImage;

class CarImageController extends Controller
{
    public function show(Request $request, Car $car)
    {
        $carImages = $car->images;
        return view('cars.images', compact('car', 'carImages'));
    }

    public function edit(Request $request, Car $car)
    {
        $carImages = $car->images;
        return view('cars.editImages', compact('car', 'carImages'));
    }

    public function store(CarImageStoreRequest $request, Car $car)
    {
        foreach ($request->file('images') as $image) {

            $imageName = uniqid() . '_' . time() . '.' . $image->extension();

            $car_image = new CarImage();
            $car_image->car_id = $car->id;
            $car_image->img = $imageName;
            $car_image->save();
            $image->storeAs('cars/' . $car->id, $imageName);
        }

        return redirect()->back()->with('success', "Foto's geüpload!");
    }

    public function delete(Request $request, $carImage) {

    }
}

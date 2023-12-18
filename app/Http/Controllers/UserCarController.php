<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;
use Illuminate\Support\Facades\Storage;

class UserCarController extends Controller
{
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        return view('cars.user.create', compact('brands'));
    }

    public function store(CarStoreRequest $request)
    {
        $car = new Car();
        $car->title = $request->title;
        $car->mileage = $request->mileage;
        $car->year = $request->year;
        $car->price = $request->price;
        $car->plate = $request->plate;
        $car->description = $request->description;
        $car->mot = Carbon::parse($request->mot);
        $car->brand_id = $request->brand;
        $car->user_id = Auth::user()->id;
        $car->save();

        return redirect()->route('user.cars')->with('success', 'Auto opgeslagen');
    }

    public function update(CarUpdateRequest $request, Car $car)
    {
        $this->authorize('hasCar', [Car::class, $car]);

        $car->title = $request->title;
        $car->mileage = $request->mileage;
        $car->year = $request->year;
        $car->price = $request->price;
        $car->plate = $request->plate;
        $car->description = $request->description;
        $car->mot = Carbon::parse($request->mot);
        $car->brand_id = $request->brand;
        $car->save();

        return redirect()->route('user.cars.info', compact('car'))->with('success', 'Auto opgeslagen');
    }

    public function index(Request $request)
    {
        $query = $request->input('query');

        $cars = Car::where('user_id', '=', Auth::user()->id)
            ->where('title', 'like', "%$query%")
            ->orderBy('title')->paginate(10);

        return view('cars.own', compact('cars'));
    }

    public function info(Request $request, Car $car)
    {
        $this->authorize('hasCar', [Car::class, $car]);

        return view('cars.user.info', compact('car'));
    }

    public function edit(Request $request, Car $car)
    {
        $this->authorize('hasCar', [Car::class, $car]);

        $brands = Brand::orderBy('name')->get();
        return view('cars.user.edit', compact('car', 'brands'));
    }

    public function delete(Car $car)
    {
        $this->authorize('hasCar', [Car::class, $car]);

        Storage::deleteDirectory('cars/' . $car->id);
        $car->delete();
        return redirect()->route('user.cars')->with('success', 'Auto verwijderd');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RespondRequest;
use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Mail\ResponderMail;
use App\Mail\SellerMail;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $cars = Car::where('title', 'like', "%$query%")
            ->orWhere('price', 'like', "%$query%")
            ->orWhere('year', 'like', "%$query%")
            ->orderBy('created_at')->paginate(10);
        return view('cars.index', compact('cars'));
    }

    public function dashboard(Request $request)
    {
        $query = $request->input('query');
        $cars = Car::where('title', 'like', "%$query%")
            ->orWhere('price', 'like', "%$query%")
            ->orWhere('year', 'like', "%$query%")
            ->orderBy('created_at')->paginate(10);
        return view('cars.dashboard', compact('cars'));
    }

    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        return view('cars.create', compact('brands'));
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

        return redirect()->route('dashboard.cars')->with('success', 'Auto opgeslagen');
    }

    public function update(CarUpdateRequest $request, Car $car)
    {
        $car->title = $request->title;
        $car->mileage = $request->mileage;
        $car->year = $request->year;
        $car->price = $request->price;
        $car->plate = $request->plate;
        $car->description = $request->description;
        $car->mot = Carbon::parse($request->mot);
        $car->brand_id = $request->brand;
        $car->save();

        return redirect()->route('dashboard.cars')->with('success', 'Auto opgeslagen');
    }

    public function own(Request $request)
    {
        $query = $request->input('query');
        // $cars = Auth::user()->cars;

        $cars = Car::where('user_id', '=', Auth::user()->id)
            ->where('title', 'like', "%$query%")
            ->orderBy('title')
            ->get();

        return view('cars.own', compact('cars'));
    }

    public function show(Request $request, Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function info(Request $request, Car $car)
    {
        return view('cars.info', compact('car'));
    }

    public function properties(Request $request, Car $car)
    {
        return view('cars.properties', compact('car'));
    }

    public function respond(Request $request, Car $car)
    {
        return view('cars.respond', compact('car'));
    }

    public function postResponse(RespondRequest $request, Car $car)
    {

        Mail::to($car->email)->send(new SellerMail($car, $request));
        Mail::to($request->email)->send(new ResponderMail($car, $request));

        sleep(1);

        return redirect()->route('cars.show', compact('car'))->with('success', 'Reactie verstuurd! Er is een bevestiging naar je inbox gestuurd');
    }

    public function edit(Request $request, Car $car)
    {
        $brands = Brand::orderBy('name')->get();
        return view('cars.edit', compact('car', 'brands'));
    }

    public function delete(Car $car)
    {
        Storage::deleteDirectory('cars/' . $car->id);
        $car->delete();
        return redirect()->route('dashboard.cars')->with('success', 'Auto verwijderd');
    }
}

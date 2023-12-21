<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Mail\SellerMail;
use App\Mail\ResponderMail;
use Illuminate\Http\Request;
use App\Models\HouseResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RespondRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HouseStoreRequest;

class HouseController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $houses = House::where('address', 'like', "%$query%")
            ->orWhere('city', 'like', "%$query%")
            ->orWhere('rent', 'like', "%$query%")
            ->orderBy('created_at')->paginate(10);
        return view('guest.houses.index', compact('houses'));
    }

    public function dashboard(Request $request)
    {
        $query = $request->input('query');
        $houses = House::where('address', 'like', "%$query%")
            ->orWhere('city', 'like', "%$query%")
            ->orWhere('rent', 'like', "%$query%")
            ->orderBy('created_at')->paginate(10);
        return view('dashboard.houses.index', compact('houses'));
    }

    public function create()
    {
        return view('dashboard.houses.create');
    }

    public function show(House $house)
    {
        return view('guest.houses.show', compact('house'));
    }

    public function respond(House $house)
    {
        return view('guest.houses.respond', compact('house'));
    }

    public function store(HouseStoreRequest $request)
    {
        $house = new House();
        $house->address = $request->address;
        $house->postal_code = $request->postal_code;
        $house->city = $request->city;
        $house->rooms = $request->rooms;
        $house->rent = $request->rent;
        $house->description = $request->description;
        $house->user_id = Auth::user()->id;
        $house->save();

        return redirect()->route('dashboard.houses.show', compact('house'))->with('success', 'Huis opgeslagen');
    }

    public function update(HouseStoreRequest $request, House $house)
    {
        $this->authorize('hasHouse', [House::class, $house]);

        $house->address = $request->address;
        $house->postal_code = $request->postal_code;
        $house->city = $request->city;
        $house->rooms = $request->rooms;
        $house->rent = $request->rent;
        $house->description = $request->description;
        $house->user_id = Auth::user()->id;
        $house->save();

        return redirect()->route('dashboard.houses.info', compact('house'))->with('success', 'Huis opgeslagen');
    }

    public function edit(House $house)
    {
        $this->authorize('hasHouse', [House::class, $house]);

        return view('dashboard.houses.edit', compact('house'));
    }

    public function editImages(House $house)
    {
        $this->authorize('hasHouse', [House::class, $house]);

        return view('dashboard.houses.editImages');
    }

    public function info(House $house)
    {
        $this->authorize('hasHouse', [House::class, $house]);

        return view('dashboard.houses.info', compact('house'));
    }

    public function delete(House $house)
    {
        $this->authorize('hasHouse', [House::class, $house]);
        Storage::deleteDirectory('houses/' . $house->id);
        $house->delete();
        return redirect()->route('dashboard.houses.index')->with('success', 'Huis verwijderd!');
    }

    public function postResponse(RespondRequest $request, House $house)
    {
        $house_response = new HouseResponse();
        $house_response->house_id = $house->id;
        $house_response->user_id = Auth::user()->id ?? null;
        $house_response->name = $request->name;
        $house_response->email = $request->email;
        $house_response->telephone = $request->telephone;
        $house_response->message = $request->message;
        $house_response->save();

        Mail::to($house->user->email)->send(new SellerMail($house, $request));
        Mail::to($request->email)->send(new ResponderMail($house, $request));

        // wacht op response hier

        $house_response = new House;

        sleep(1);



        return redirect()->route('houses.show', compact('house'))->with('success', 'Reactie verstuurd! Er is een bevestiging naar je inbox gestuurd');
    }
}

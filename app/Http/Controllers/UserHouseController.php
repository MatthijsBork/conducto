<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HouseStoreRequest;
use App\Http\Requests\HouseUpdateRequest;

class UserHouseController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $houses = House::where('user_id', '=', Auth::user()->id)
            ->where('address', 'like', "%$query%")
            ->orderBy('address')->paginate(10);

        return view('user.houses.index', compact('houses'));
    }

    public function create()
    {
        return view('user.houses.create');
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

        return redirect()->route('user.houses.info', compact('house'))->with('success', 'Huis opgeslagen');
    }

    public function edit(House $house)
    {
        $this->authorize('hasHouse', $house);

        return view('user.houses.edit', compact('house'));
    }

    public function update(HouseUpdateRequest $request, House $house)
    {
        $house->address = $request->address;
        $house->postal_code = $request->postal_code;
        $house->city = $request->city;
        $house->rooms = $request->rooms;
        $house->rent = $request->rent;
        $house->description = $request->description;
        $house->user_id = Auth::user()->id;
        $house->save();

        return redirect()->route('user.houses.info', compact('house'))->with('success', 'Huis opgeslagen');
    }

    public function editImages(House $house)
    {
        $this->authorize('hasHouse', $house);

        return view('user.houses.editImages');
    }

    public function show(House $house)
    {
        return view('user.houses.show', compact('house'));
    }

    public function info(House $house)
    {
        $this->authorize('hasHouse', $house);

        return view('user.houses.info', compact('house'));
    }

    public function delete(House $house)
    {
        $this->authorize('hasHouse', $house);
        Storage::deleteDirectory('houses/' . $house->id);
        $house->delete();
        return redirect()->route('user.houses')->with('success', 'Huis verwijderd!');
    }
}

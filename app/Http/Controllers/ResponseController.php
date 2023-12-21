<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\HouseResponse;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = $request->input('query');

        $responses = HouseResponse::where('name', 'like', "%$query%")->orderBy('created_at')->paginate(10);
        return view('dashboard.responses.index', compact('responses'));
    }

    public function create()
    {
        $houses = House::all();

        return view('dashboard.responses.create', compact('houses'));
    }

    public function houseIndex(Request $request, House $house)
    {
        $query = $request->input('query');
        $responses = $house->responses()
            ->where('name', 'like', "%$query%")
            ->orderBy('created_at')->paginate(10);

        return view('user.houses.responses', compact('house', 'responses'));
    }

    public function show(Request $request, House $house, HouseResponse $house_response)
    {
        $this->authorize('hasResponse', [HouseResponse::class, $house_response]);

        return view('user.responses.show', compact('house', 'house_response'));
    }

    public function responseShow(Request $request, House $house, HouseResponse $house_response)
    {
        $this->authorize('hasHouse', [House::class, $house]);

        return view('user.houses.response-show', compact('house', 'house_response'));
    }

    public function delete(Request $request, House $house, HouseResponse $house_response)
    {
        $this->authorize('hasResponse', [HouseResponse::class, $house_response]);

        $house_response->delete();

        return redirect()->route('user.responses')->with('success', 'Reactie verwijderd!');
    }

    public function accept(Request $request, House $house, HouseResponse $house_response)
    {
        $this->authorize('hasHouse', [House::class, $house]);

        $house_response->status = 1;
        $house_response->save();

        return redirect()->route('user.houses.responses.show', compact('house', 'house_response'))->with('success', 'Reactie geaccepteerd!');
    }

    public function decline(Request $request, House $house, HouseResponse $house_response)
    {
        $this->authorize('hasHouse', [House::class, $house]);

        $house_response->delete();

        return redirect()->route('user.houses.responses', compact('house'))->with('success', 'Reactie geweigerd!');
    }
}

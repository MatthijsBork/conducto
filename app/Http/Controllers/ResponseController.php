<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Mail\SellerMail;
use App\Models\Response;
use App\Mail\ResponderMail;
use Illuminate\Http\Request;
use App\Models\HouseResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RespondRequest;

class ResponseController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $house_responses = HouseResponse::orderBy('created_at')->paginate(10);

        return view('dashboard.responses.index', compact('house_responses'));
    }

    public function create()
    {
        $houses = House::all();

        return view('dashboard.responses.create', compact('houses'));
    }

    public function edit(Request $request, HouseResponse $house_response)
    {
        $houses = House::all();

        return view('dashboard.responses.edit', compact('house_response', 'houses'));
    }

    public function update(Request $request, HouseResponse $house_response)
    {
        $house_response->house_id = $request->house;
        $house_response->user_id = Auth::user()->id ?? null;
        $house_response->status= $request->status;
        $house_response->name = $request->name;
        $house_response->email = $request->email;
        $house_response->telephone = $request->telephone;
        $house_response->message = $request->message;
        $house_response->save();

        return redirect()->route('dashboard.responses')->with('success', 'Reactie bijgewerkt');
    }

    public function store(RespondRequest $request)
    {
        $house_response = new HouseResponse();
        $house_response->house_id = $request->house;
        $house_response->user_id = Auth::user()->id ?? null;
        $house_response->name = $request->name;
        $house_response->email = $request->email;
        $house_response->telephone = $request->telephone;
        $house_response->message = $request->message;
        $house_response->save();

        return redirect()->route('dashboard.responses')->with('success', 'Reactie verstuurd! Er is een bevestiging naar je inbox gestuurd');
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

    public function delete(Request $request, HouseResponse $house_response)
    {
        $house_response->delete();

        return redirect()->route('dashboard.responses')->with('success', 'Reactie verwijderd!');
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

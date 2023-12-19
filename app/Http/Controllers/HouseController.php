<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Mail\SellerMail;
use App\Mail\ResponderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RespondRequest;

class HouseController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $houses = House::where('address', 'like', "%$query%")
            ->orWhere('rent', 'like', "%$query%")
            ->orderBy('created_at')->paginate(10);
        return view('guest.houses.index', compact('houses'));
    }

    public function dashboard(Request $request)
    {
        $query = $request->input('query');
        $houses = House::where('address', 'like', "%$query%")
            ->orWhere('price', 'like', "%$query%")
            ->orderBy('created_at')->paginate(10);
        return view('dashboard.houses.index', compact('houses'));
    }

    public function show(House $house)
    {
        return view('guest.houses.show', compact('house'));
    }

    public function respond(House $house)
    {
        return view('guest.houses.respond', compact('house'));
    }

    public function postResponse(RespondRequest $request, House $house)
    {

        Mail::to($house->email)->send(new SellerMail($house, $request));
        Mail::to($request->email)->send(new ResponderMail($house, $request));

        sleep(1);

        return redirect()->route('houses.show', compact('house'))->with('success', 'Reactie verstuurd! Er is een bevestiging naar je inbox gestuurd');
    }
}

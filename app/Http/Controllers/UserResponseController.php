<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\HouseResponse;
use Illuminate\Support\Facades\Auth;

class UserResponseController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $responses = HouseResponse::where('user_id', '=', Auth::user()->id)
            ->where('name', 'like', "%$query%")
            ->orderBy('created_at')->paginate(10);
        return view('user.responses.index', compact('responses'));
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

        $response = $house_response;
        return view('user.responses.show', compact('house', 'house_response'));
    }
}

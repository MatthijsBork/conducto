<?php

namespace App\Http\Controllers;

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
}

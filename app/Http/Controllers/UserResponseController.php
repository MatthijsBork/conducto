<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserResponseController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $responses = Response::where('user_id', '=', Auth::user()->id)
            ->where('address', 'like', "%$query%")
            ->orderBy('address')->paginate(10);

        return view('user.responses.index', compact('responses'));
    }
}

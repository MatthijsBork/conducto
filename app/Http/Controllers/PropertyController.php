<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Requests\PropertyStoreRequest;
use App\Http\Requests\PropertyUpdateRequest;

class PropertyController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = $request->input('query');

        $properties = Property::where('name', 'like', "%$query%")
            ->orderBy('created_at')
            ->paginate(10);
        return view('properties.dashboard', compact('properties'));
    }

    public function create()
    {
        return view('properties.create');
    }

    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));;
    }

    public function store(PropertyStoreRequest $request)
    {
        $property = new Property();
        $property->name = $request->input('name');
        $property->save();
        return redirect()->route('dashboard.properties')->with('success', 'Nieuwe eigenschap toegevoegd');
    }

    public function update(PropertyUpdateRequest $request, Property $property)
    {
        $property->name = $request->name;
        $property->save();

        return redirect()->route('dashboard.properties')->with('success', 'Eigenschap bijgewerkt');
    }

    public function delete(Property $property)
    {
        $property->delete();
        return redirect()->route('dashboard.properties')->with('success', 'Eigenschap verwijderd');
    }
}

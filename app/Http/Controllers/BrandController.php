<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;

class BrandController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = $request->input('query');

        $brands = Brand::where('name', 'like', "%$query%")
            ->orderBy('created_at')
            ->paginate(10);
        return view('brands.dashboard', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));;
    }

    public function store(BrandStoreRequest $request)
    {
        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->save();
        return redirect()->route('dashboard.brands')->with('success', 'Nieuwe merk toegevoegd');
    }

    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $brand->name = $request->name;
        $brand->save();

        return redirect()->route('dashboard.brands')->with('success', 'Merk bijgewerkt');
    }

    public function delete(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('dashboard.brands')->with('success', 'Merk verwijderd');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\HouseImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\HouseImageStoreRequest;

class HouseImageController extends Controller
{
    public function show(House $house)
    {
        $house_images = $house->images()->get();
        return view('dashboard.houses.images', compact('house', 'house_images'));
    }

    public function edit(House $house)
    {
        $house_images = $house->images()->get();
        return view('dashboard.houses.editImages', compact('house', 'house_images'));
    }

    public function store(HouseImageStoreRequest $request, House $house)
    {
        foreach ($request->file('images') as $image) {

            $imageName = uniqid() . '_' . time() . '.' . $image->extension();

            $house_image = new HouseImage();
            $house_image->house_id = $house->id;
            $house_image->img = $imageName;
            $house_image->save();
            $image->storeAs('houses/' . $house->id, $imageName);
        }

        return redirect()->back()->with('success', "Foto's geüpload!");
    }

    public function delete(House $house, HouseImage $image)
    {
        $image->delete();
        Storage::delete('houses/' . $house->id . '/' . $image->img);
        return redirect()->back()->with('success', 'Foto verwijderd!');
    }
}

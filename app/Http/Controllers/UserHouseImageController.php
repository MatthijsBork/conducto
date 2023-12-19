<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use App\Http\Requests\HouseImageStoreRequest;
use App\Models\HouseImage;

class UserHouseImageController extends Controller
{
    public function show(Request $request, House $house)
    {
        $houseImages = $house->images;
        return view('user.houses.images', compact('house', 'houseImages'));
    }

    public function edit(Request $request, House $house)
    {
        $houseImages = $house->images;
        return view('houses.user.editImages', compact('house', 'houseImages'));
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
}

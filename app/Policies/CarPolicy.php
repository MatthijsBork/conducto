<?php

namespace App\Policies;

use App\Models\User;
use App\Models\House;

class HousePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function hasCar(User $user, House $house)
    {
        return $house->user->id == $user->id;
    }
}

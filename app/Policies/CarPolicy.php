<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;

class CarPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function hasCar(User $user, Car $car)
    {
        return $car->user->id == $user->id;
    }
}

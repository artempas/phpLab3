<?php

namespace App\Actions;

use App\Models\Airport;
use App\Models\Flight;

class FlightGetAction
{
    public function handle(int $id) : Flight
    {
        return Flight::findOrFail($id);
    }
}

<?php

namespace App\Actions;

use App\Models\Flight;
class FlightCreateAction
{
    public function handle($request) : Flight
    {
        return Flight::create($request->validated());
    }
}

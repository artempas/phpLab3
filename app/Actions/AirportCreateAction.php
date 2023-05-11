<?php

namespace App\Actions;

use App\Models\Airport;

class AirportCreateAction
{
    public function handle($request) : Airport
    {
        return Airport::create($request->validated());
    }

}

<?php

namespace App\Actions;

use App\Models\Airport;

class AirportGetAction
{
    public function handle(string $id) : Airport
    {
        return Airport::findOrFail($id);
    }
}

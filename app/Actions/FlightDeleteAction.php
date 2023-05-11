<?php

namespace App\Actions;

use App\Http\Resources\FlightResource;
use App\Models\Flight;
use Illuminate\Http\Response;

class FlightDeleteAction
{
    public function handle($id) : Flight
    {
        $airport = Flight::findOrFail($id);

        $airport->delete();

        return $airport;
    }
}

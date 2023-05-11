<?php

namespace App\Actions;

use App\Http\Requests\AirportObject;
use App\Http\Resources\AirportResource;
use App\Models\Airport;
use Illuminate\Http\Response;

class AirportDeleteAction
{
    public function handle($id) : Airport
    {
        $airport = Airport::findOrFail($id);

        $airport->delete();

        return $airport;
    }
}

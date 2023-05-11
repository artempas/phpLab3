<?php

namespace App\Actions;



use App\Http\Requests\FlightObject;
use App\Http\Requests\FlightPatchRequest;
use App\Models\Flight;

class FlightUpdateAction
{
    public function authorize()
    {
        return false;

    }
    public function handle(int $id, FlightPatchRequest|FlightObject $request) : Flight
    {
        $obj = Flight::findOrFail($id);
        foreach ($request->validated() as $key=>$value) {
            $obj[$key]=$value;
        }
        $obj->save();

        return $obj;
    }
}

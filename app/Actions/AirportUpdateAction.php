<?php

namespace App\Actions;

use App\Http\Requests\AirportObject;
use App\Http\Requests\AirportPatchRequest;
use App\Models\Airport;

class AirportUpdateAction
{
    public function authorize()
    {
        return false;

    }
    public function handle(string $id, AirportPatchRequest|AirportObject $request) : Airport
    {
        $obj = Airport::findOrFail($id);
        foreach ($request->validated() as $key=>$value) {
            $obj[$key]=$value;
        }
        $obj->save();
        return $obj;
    }
}

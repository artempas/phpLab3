<?php

namespace App\Http\Controllers\Api;

use App\Actions\FlightDeleteAction;
use App\Actions\FlightGetAction;
use App\Actions\FlightUpdateAction;
use App\Actions\FlightCreateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlightFilterRequest;
use App\Http\Requests\FlightObject;
use App\Http\Requests\FlightPatchRequest;
use App\Http\Resources\FlightResource;
use App\Models\Flight;
use Illuminate\Http\Response;

class FlightController extends Controller
{
    public function createFlight(FlightObject $request, FlightCreateAction $action) : FlightResource
    {
        return new FlightResource($action->handle($request));
    }
    public function deleteFlight(int $id, FlightDeleteAction $action) : FlightResource
    {
        return new FlightResource($action->handle($id));
    }
    public function patchFlight(int $id, FlightPatchRequest $request, FlightUpdateAction $action) : FlightResource
    {
        return new FlightResource($action->handle($id, $request));
    }
    public function updateFlight(int $id, FlightObject $request, FlightUpdateAction $action) : FlightResource{
        return new FlightResource($action->handle($id, $request));
    }
    public function filterFlights(FlightFilterRequest $request)
    {
        $filters = $request->validated();
        $query = Flight::query();
        if(!empty($filters)) {
            foreach($filters as $field => $value) {
                $query->where($field, $value);
            }
        }

        // Execute the query and return the results
        $filteredFlights = $query->get();
        return response()->json(['data' => $filteredFlights], 200);
    }
    public function getFlight(int $id, FlightGetAction $action) : FlightResource{
        return new FlightResource($action->handle($id));
    }
}

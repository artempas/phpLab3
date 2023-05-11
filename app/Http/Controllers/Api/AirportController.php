<?php

namespace App\Http\Controllers\Api;

use App\Actions\AirportCreateAction;
use App\Actions\AirportDeleteAction;
use App\Actions\AirportGetAction;
use App\Actions\AirportUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AirportFilterRequest;
use App\Http\Requests\AirportObject;
use App\Http\Requests\AirportPatchRequest;
use App\Http\Resources\AirportResource;
use App\Models\Airport;
use Illuminate\Http\Response;

class AirportController extends Controller
{
    public function createAirport(AirportObject $request, AirportCreateAction $action) : AirportResource
    {
        return new AirportResource($action->handle($request));
    }
    public function deleteAirport(string $id, AirportDeleteAction $action) : AirportResource
    {
        return new AirportResource($action->handle($id));
    }
    public function patchAirport(string $id, AirportPatchRequest $request, AirportUpdateAction $action) : AirportResource
    {
        return new AirportResource($action->handle($id, $request));
    }
    public function updateAirport(string $id, AirportObject $request, AirportUpdateAction $action) : AirportResource{
        return new AirportResource($action->handle($id, $request));
    }
    public function filterAirports(AirportFilterRequest $request)
    {
        $filters = $request->validated();
        $query = Airport::query();
        if(!empty($filters)) {
            foreach($filters as $field => $value) {
                $query->where($field, 'like', '%'.$value.'%');
            }
        }

        // Execute the query and return the results
        $filteredAirports = $query->get();
        return response()->json(['data' => $filteredAirports], 200);
    }

    public function getAirport(string $id, AirportGetAction $action) : AirportResource{
        return new AirportResource($action->handle($id));
    }
}

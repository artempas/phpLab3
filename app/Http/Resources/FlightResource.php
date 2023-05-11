<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id'=>$this->id,
        'flightNo'=>$this->flightNo,
        'airline'=>$this->airline,
        "departureTimeScheduled" =>date('c', strtotime($this->departureTimeScheduled)),
        "departureTimeActual" =>date('c', strtotime($this->departureTimeActual)),
        "arrivalTimeScheduled" =>date('c', strtotime($this->arrivalTimeScheduled)),
        "arrivalTimeActual" =>date('c', strtotime($this->arrivalTimeActual)),
        'departureAirport'=>$this->departureAirport,
        'arrivalAirport'=>$this->arrivalAirport,
        ];
    }
}

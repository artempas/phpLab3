<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightPatchRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id'=>'int',
            'flightNo' => 'max:6',
            'departureTimeScheduled' => 'date',
            'departureTimeActual' => 'date',
            'departureAirport'=>'max:3',
            'arrivalAirport'=>'max:3',
            'arrivalTimeScheduled' => 'date',
            'arrivalTimeActual' => 'date',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightObject extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'flightNo' => 'required|max:6',
            'airline' => 'required',
            'departureTimeScheduled' => 'date|required',
            'departureTimeActual' => 'date',
            'departureAirport'=>'required|max:3|exists:airports,IATACode',
            'arrivalAirport'=>'required|max:3|exists:airports,IATACode',
            'arrivalTimeScheduled' => 'date|required',
            'arrivalTimeActual' => 'date',
        ];
    }
}

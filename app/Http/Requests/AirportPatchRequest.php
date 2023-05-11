<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AirportPatchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'IATACode'=>'max:3|unique:airports,IATACode',
            "city"=>"string"
        ];
    }
}

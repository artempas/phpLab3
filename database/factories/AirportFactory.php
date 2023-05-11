<?php

namespace Database\Factories;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirportFactory extends Factory
{
    protected $model = Airport::class;

    public function definition()
    {
        return [
            'IATACode' => fake()->unique()->regexify('[A-Z]{3}'),
            'city' => fake()->city,
        ];
    }
}

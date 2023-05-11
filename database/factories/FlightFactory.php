<?php

namespace Database\Factories;

use App\Models\Flight;
use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition()
    {
        $departureAirport = Airport::inRandomOrder()->first();
        $arrivalAirport = Airport::where('IATACode', '<>', $departureAirport->IATACode)->inRandomOrder()->first();

        $departureTimeScheduled = $this->faker->dateTimeBetween('now', '+30 days');
        $arrivalTimeScheduled = $this->faker->dateTimeBetween($departureTimeScheduled, '+30 days');

        return [
            'flightNo' => $this->faker->unique()->regexify('[A-Z]{3}\d{2}'),
            'airline' => $this->faker->company,
            'departureTimeScheduled' => $departureTimeScheduled,
            'departureTimeActual' => $departureTimeScheduled,
            'arrivalTimeScheduled' => $arrivalTimeScheduled,
            'arrivalTimeActual' => $arrivalTimeScheduled,
            'departureAirport' => $departureAirport->IATACode,
            'arrivalAirport' => $arrivalAirport->IATACode,
        ];
    }
}

<?php

namespace Tests\Unit;

use App\Actions\FlightUpdateAction;
use App\Http\Resources\FlightResource;
use App\Models\Airport;
use App\Models\Flight;
use Database\Seeders\AirportSeeder;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlightTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_flight()
    {
        $this->seed(AirportSeeder::class);
        $obj=Flight::factory()->raw();
        $obj['departureTimeScheduled']=$obj['departureTimeScheduled']->format(DateTime::ATOM);
        $obj['departureTimeActual']=$obj['departureTimeScheduled'];
        $obj['arrivalTimeScheduled']=$obj['arrivalTimeScheduled']->format(DateTime::ATOM);
        $obj['arrivalTimeActual']=$obj['arrivalTimeScheduled'];
        dump($obj);
        $response = $this->postJson('/api/v1/flights', $obj);
        $response->assertStatus(201);

        $this->assertDatabaseHas('flights', $obj);
    }

    /** @test */
    public function can_update_flight()
    {
        $this->seed(AirportSeeder::class);
        $flight = Flight::factory()->create();
        $obj=Flight::factory()->raw();
        $obj['departureTimeScheduled']=$obj['departureTimeScheduled']->format(DateTime::ATOM);
        $obj['departureTimeActual']=$obj['departureTimeScheduled'];
        $obj['arrivalTimeScheduled']=$obj['arrivalTimeScheduled']->format(DateTime::ATOM);
        $obj['arrivalTimeActual']=$obj['arrivalTimeScheduled'];
        dump($obj);
        $response = $this->putJson("/api/v1/flights/{$flight->id}", $obj);
        $response->assertStatus(200);

        $this->assertDatabaseHas('flights', $obj);
        $this->assertDatabaseMissing('flights', [
            'number' => $flight->number,
            'departure_date_time' => $flight->departure_date_time,
            'arrival_date_time' => $flight->arrival_date_time,
            'departure_airport' => $flight->departure_airport_iata_code,
            'arrival_airport' => $flight->arrival_airport_iata_code,
        ]);
    }

    /** @test */
    public function can_delete_flight()
    {
        $this->seed(AirportSeeder::class);

        $flight = Flight::factory()->create();

        $response = $this->deleteJson("/api/v1/flights/{$flight->id}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('flights', $flight->toArray());
    }

    /** @test */
    public function can_get_all_flights()
    {
        $this->seed(AirportSeeder::class);

        $flights = Flight::factory()->count(5)->create();

        $response = $this->postJson('/api/v1/flights:search');
        $response->assertStatus(200);
        $response->assertJsonCount($flights->count(), 'data');
    }

    /** @test */
    public function can_get_single_flight()
    {
        $this->seed(AirportSeeder::class);
        $flight = Flight::factory()->create();
        $response = $this->getJson("/api/v1/flights/{$flight->id}");
        $response->assertStatus(200);
        $array=$flight->toArray();
        dump($array);
        $response->assertJsonFragment([
            "flightNo" =>$flight->flightNo,
            "airline" =>$flight->airline,
            "departureTimeScheduled" =>$flight->departureTimeScheduled->format(DateTime::ATOM),
            "departureTimeActual" =>$flight->departureTimeActual->format(DateTime::ATOM),
            "arrivalTimeScheduled" =>$flight->arrivalTimeScheduled->format(DateTime::ATOM),
            "arrivalTimeActual" =>$flight->arrivalTimeActual->format(DateTime::ATOM),
            "departureAirport" =>$flight->departureAirport,
            "arrivalAirport" =>$flight->arrivalAirport,
        ]);
    }
}

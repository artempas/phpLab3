<?php

namespace Tests\Unit;

use App\Models\Airport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AirportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_airport()
    {
        $attributes = [
            'IATACode' => 'MOW',
            'city' => 'Moscow',
        ];

        $response = $this->postJson('/api/v1/airports', $attributes);

        $response->assertStatus(201);

        $this->assertDatabaseHas('airports', $attributes);
    }

    /** @test */
    public function can_update_airport()
    {
        $airport = Airport::factory()->create();

        $attributes = [
            'IATACode' => 'LED',
            'city' => 'Saint Petersburg',
        ];

        $response = $this->putJson('/api/v1/airports/' . $airport->IATACode, $attributes);

        if ($response->status() !== 200) {
            dump($response->content());
        }
        $response->assertStatus(200);

        $this->assertDatabaseHas('airports', $attributes);
    }

    /** @test */
    public function can_patch_airport()
    {
        $airport = Airport::factory()->create();

        $attributes = [
            'city' => 'Saint Petersburg',
        ];

        $response = $this->patchJson('/api/v1/airports/' . $airport->IATACode, $attributes);
        $attributes['IATACode']=$airport->IATACode;
        dump($attributes);
        if ($response->status() !== 200) {
            dump($response->content());
        }
        $response->assertStatus(200);

        $this->assertDatabaseHas('airports', $attributes);
    }

    /** @test */
    public function can_delete_airport()
    {
        $airport = Airport::factory()->create();

        $response = $this->deleteJson('/api/v1/airports/' . $airport->IATACode);

        if ($response->status() !== 200) {
            dump($response->content());
        }
        $response->assertStatus(200);
        $this->assertDatabaseMissing('airports', ['IATACode' => $airport->IATACode]);
    }

    /** @test */
    public function can_list_airports()
    {
        $airports = Airport::factory()->count(5)->create();

        $response = $this->postJson('/api/v1/airports:search');

        if ($response->status() !== 200) {
            dump($response->content());
        }
        $response->assertStatus(200);

        $response->assertJsonCount(5, 'data');
    }

    /** @test */
    public function can_show_airport()
    {
        $airport = Airport::factory()->create();

        $response = $this->getJson('/api/v1/airports/' . $airport->IATACode);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'IATACode' => $airport->IATACode,
            'city' => $airport->city,
        ]);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('flightNo', 5);
            $table->string('airline');
            $table->dateTimeTz('departureTimeScheduled', 0);
            $table->dateTimeTz('departureTimeActual', 0);
            $table->dateTimeTz('arrivalTimeScheduled', 0);
            $table->dateTimeTz('arrivalTimeActual', 0);
            $table->string('departureAirport', 3);
            $table->string('arrivalAirport', 3);
            $table->foreign('departureAirport')->references('IATACode')->on('airports')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('arrivalAirport')->references('IATACode')->on('airports')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};

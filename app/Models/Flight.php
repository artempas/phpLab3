<?php

namespace App\Models;

use Database\Factories\FlightFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'flightNo',
        'airline',
        'departureTimeScheduled',
        'departureTimeActual',
        'arrivalTimeScheduled',
        'arrivalTimeActual',
        'departureAirport',
        'arrivalAirport',
    ];
    public function departureAirport():belongsTo{
        return $this->belongsTo(Airport::class, 'departureAirport');
    }
    public function arrivalAirport():belongsTo{
        return $this->belongsTo(Airport::class, 'arrivalAirport');
    }
    protected static function newFactory()
    {
        return FlightFactory::new();
    }
}

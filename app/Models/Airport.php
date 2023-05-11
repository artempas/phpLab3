<?php

namespace App\Models;

use Database\Factories\AirportFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airport extends Model
{
    use HasFactory;
    protected $primaryKey = 'IATACode';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'city',
        'IATACode',
    ];
    protected static function newFactory()
    {
        return AirportFactory::new();
    }
    public function departures(): HasMany {
        return $this->hasMany(Airport::class, 'departureAirport', 'IATACode');
    }
    public function arrivals(): HasMany {
        return $this->hasMany(Airport::class, 'arrivalAirport', 'IATACode');
    }
}

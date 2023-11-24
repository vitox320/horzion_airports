<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'departure_date' => 'datetime:d/m/Y H:i:s',
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s',
        'deleted_at' => 'datetime:d/m/Y H:i:s',
    ];
    protected $fillable = [
        'flight_number',
        'departure_date',
        'flight_origin_id',
        'flight_destination_id',
    ];

    public function flightOriginAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'flight_origin_id');
    }

    public function flightDestinationAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'flight_destination_id');
    }

    public function flightClass(): HasMany
    {
        return $this->hasMany(FlightClass::class);
    }

    public function seats(): HasManyThrough
    {
        return $this->hasManyThrough(Seat::class, FlightClass::class);
    }
}

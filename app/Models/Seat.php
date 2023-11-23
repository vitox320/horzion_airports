<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'seat_number',
        'price',
        'flight_class_id'
    ];

    public function flightClass(): BelongsTo
    {
        return $this->belongsTo(FlightClass::class,'flight_class_id');
    }
}

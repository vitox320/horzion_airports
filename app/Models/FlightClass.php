<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlightClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'seats_qty',
        'flight_class_type_id',
        'flight_id'
    ];

    public function flightClassType(): BelongsTo
    {
        return $this->belongsTo(FlightClassType::class, 'flight_class_type_id');
    }

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class, 'flight_id', 'id');
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }
}

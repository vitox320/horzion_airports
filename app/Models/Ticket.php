<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ticket_number',
        'price',
        'seat_id',
        'passenger_id',
        'purchaser_id',
        'has_baggage_exceeded',
    ];

    public function passenger(): BelongsTo
    {
        return $this->belongsTo(Passenger::class, 'passenger_id');
    }

    public function purchaser(): BelongsTo
    {
        return $this->belongsTo(Passenger::class, 'purchaser_id');
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }
}

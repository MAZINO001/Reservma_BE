<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{
    protected $fillable = [
        'booking_id',
        'service_id',
        'price',
        'duration',
    ];

    protected $casts = [
        'price'    => 'decimal:2',
        'duration' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}

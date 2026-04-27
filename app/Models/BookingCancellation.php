<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingCancellation extends Model
{
    protected $fillable = [
        'booking_id',
        'cancelled_by',
        'reason',
        'cancelled_at',
    ];

    protected $casts = [
        'cancelled_at'   => 'datetime',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function cancelledByUser()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'customer_id',
        'business_id',
        'booking_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating'      => 'integer',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerProfile::class, 'customer_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}

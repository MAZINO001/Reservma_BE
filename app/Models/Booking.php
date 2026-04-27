<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_id',
        'business_id',
        'booking_date',
        'start_time',
        'end_time',
        'notes',
        'status',
        'is_no_show',
        'total_price',
        'confirmed_at',
        'cancelled_at',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'start_time'   => 'datetime',
        'end_time'     => 'datetime',
        'is_no_show'   => 'boolean',
        'total_price'  => 'decimal:2',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerProfile::class, 'customer_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function cancellation()
    {
        return $this->hasOne(BookingCancellation::class, 'booking_id');
    }

    public function bookingItems()
    {
        return $this->hasMany(BookingItem::class, 'booking_id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class, 'booking_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'booking_items', 'booking_id', 'service_id')
                    ->withPivot(['price', 'duration'])
                    ->withTimestamps();
    }
}

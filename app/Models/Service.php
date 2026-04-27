<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'business_id',
        'name_en',
        'name_fr',
        'name_ar',
        'description_en',
        'description_fr',
        'description_ar',
        'price',
        'duration',
        'sort_order',
        'is_active',
        'category',
        'requirements',
    ];

    protected $casts = [
        'price'      => 'decimal:2',
        'duration'   => 'integer',
        'sort_order' => 'integer',
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function bookingItems()
    {
        return $this->hasMany(BookingItem::class, 'service_id');
    }

    public function serviceImages()
    {
        return $this->hasMany(ServiceImage::class, 'service_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_items', 'service_id', 'booking_id')
                    ->withPivot(['price', 'duration'])
                    ->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'owner_id',
        'category_id',
        'name',
        'description_en',
        'description_fr',
        'description_ar',
        'gender_target',
        'city',
        'is_featured',
        'address',
        'phone',
        'slug',
        'status',
        'rating_avg',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'rating_avg'  => 'decimal:2',
        'latitude'    => 'decimal:8',
        'longitude'   => 'decimal:8',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    public function ownerProfile()
    {
        return $this->belongsTo(OwnerProfile::class, 'owner_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'business_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'business_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'business_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'business_id');
    }

    public function businessHours()
    {
        return $this->hasMany(BusinessHour::class, 'business_id');
    }

    public function businessImages()
    {
        return $this->hasMany(BusinessImage::class, 'business_id');
    }
}

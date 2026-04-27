<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'city',
        'date_of_birth',
        'gender',
        'phone',
        'avatar',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'customer_id');
    }
}

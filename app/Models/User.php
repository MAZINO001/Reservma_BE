<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes , HasApiTokens , HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'role',
        'last_login',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login'        => 'datetime',
        'deleted_at'        => 'datetime',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    public function ownerProfile()
    {
        return $this->hasOne(OwnerProfile::class, 'user_id');
    }

    public function customerProfile()
    {
        return $this->hasOne(CustomerProfile::class, 'user_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id');
    }

    public function bookingCancellations()
    {
        return $this->hasMany(BookingCancellation::class, 'cancelled_by');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'city',
        'is_verified',
        'verified_at',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function businesses()
    {
        return $this->hasMany(Business::class, 'owner_id');
    }
}

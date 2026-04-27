<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessHour extends Model
{
    protected $fillable = [
        'business_id',
        'day_of_week',
        'open_time',
        'close_time',
        'is_closed',
    ];

    protected $casts = [
        'is_closed'   => 'boolean',
        'open_time'   => 'datetime',
        'close_time'  => 'datetime',
    ];
    public function business(){
        return $this->belongsTo(Business::class , "business_id");
    }
}

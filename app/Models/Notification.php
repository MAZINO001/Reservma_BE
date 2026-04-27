<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'title_en',
        'title_fr',
        'title_ar',
        'message_en',
        'message_fr',
        'message_ar',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function user(){
    return $this->belongsTo(User::class , "user_id");
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessImage extends Model
{
    protected $fillable = [
    'business_id',
    'image_url',
];
    public function business(){
        return $this->belongsTo(Business::class , "business_id");
    }
}

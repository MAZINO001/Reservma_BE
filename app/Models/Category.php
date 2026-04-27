<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_fr',
        'name_ar',
        'slug',
        'description_en',
        'description_fr',
        'description_ar',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function businesses()
    {
        return $this->hasMany(Business::class, 'category_id');
    }
}

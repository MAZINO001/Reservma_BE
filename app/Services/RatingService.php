<?php

namespace App\Services;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Collection;

class RatingService
{
    public function getAll(): Collection
    {
        return Rating::all();
    }

    public function find(Rating $rating): Rating
    {
        return $rating;
    }

    public function create(array $data): Rating
    {
        return Rating::create($data);
    }

    public function update(Rating $rating, array $data): Rating
    {
        $rating->update($data);
        return $rating->fresh();
    }

    public function delete(Rating $rating): void
    {
        $rating->delete();
    }
}
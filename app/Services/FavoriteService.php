<?php

namespace App\Services;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Collection;

class FavoriteService
{
    public function getAll(): Collection
    {
        return Favorite::all();
    }

    public function find(Favorite $favorite): Favorite
    {
        return $favorite;
    }

    public function create(array $data): Favorite
    {
        return Favorite::create($data);
    }

    public function update(Favorite $favorite, array $data): Favorite
    {
        $favorite->update($data);
        return $favorite->fresh();
    }

    public function delete(Favorite $favorite): void
    {
        $favorite->delete();
    }
}
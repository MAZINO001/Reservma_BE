<?php

namespace App\Services;

use App\Models\Business;
use Illuminate\Database\Eloquent\Collection;

class BusinessService
{
    public function getAll(): Collection
    {
        return Business::all();
    }

    public function find(Business $business): Business
    {
        return $business;
    }

    public function create(array $data): Business
    {
        return Business::create($data);
    }

    public function update(Business $business, array $data): Business
    {
        $business->update($data);
        return $business->fresh();
    }

    public function delete(Business $business): void
    {
        $business->delete();
    }
}
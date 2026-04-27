<?php

namespace App\Services;

use App\Models\BusinessHour;
use Illuminate\Database\Eloquent\Collection;

class BusinessHourService
{
    public function getAll(): Collection
    {
        return BusinessHour::all();
    }

    public function find(BusinessHour $businessHour): BusinessHour
    {
        return $businessHour;
    }

    public function create(array $data): BusinessHour
    {
        return BusinessHour::create($data);
    }

    public function update(BusinessHour $businessHour, array $data): BusinessHour
    {
        $businessHour->update($data);
        return $businessHour->fresh();
    }

    public function delete(BusinessHour $businessHour): void
    {
        $businessHour->delete();
    }
}
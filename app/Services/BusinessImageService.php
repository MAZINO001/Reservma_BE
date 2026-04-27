<?php

namespace App\Services;

use App\Models\BusinessImage;
use Illuminate\Database\Eloquent\Collection;

class BusinessImageService
{
    public function getAll(): Collection
    {
        return BusinessImage::all();
    }

    public function find(BusinessImage $businessImage): BusinessImage
    {
        return $businessImage;
    }

    public function create(array $data): BusinessImage
    {
        return BusinessImage::create($data);
    }

    public function update(BusinessImage $businessImage, array $data): BusinessImage
    {
        $businessImage->update($data);
        return $businessImage->fresh();
    }

    public function delete(BusinessImage $businessImage): void
    {
        $businessImage->delete();
    }
}
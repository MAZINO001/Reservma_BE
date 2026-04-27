<?php

namespace App\Services;

use App\Models\ServiceImage;
use Illuminate\Database\Eloquent\Collection;

class ServiceImageService
{
    public function getAll(): Collection
    {
        return ServiceImage::all();
    }

    public function find(ServiceImage $serviceImage): ServiceImage
    {
        return $serviceImage;
    }

    public function create(array $data): ServiceImage
    {
        return ServiceImage::create($data);
    }

    public function update(ServiceImage $serviceImage, array $data): ServiceImage
    {
        $serviceImage->update($data);
        return $serviceImage->fresh();
    }

    public function delete(ServiceImage $serviceImage): void
    {
        $serviceImage->delete();
    }
}
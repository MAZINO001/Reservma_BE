<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceService
{
    public function getAll(): Collection
    {
        return Service::all();
    }

    public function find(Service $service): Service
    {
        return $service;
    }

    public function create(array $data): Service
    {
        return Service::create($data);
    }

    public function update(Service $service, array $data): Service
    {
        $service->update($data);
        return $service->fresh();
    }

    public function delete(Service $service): void
    {
        $service->delete();
    }
}
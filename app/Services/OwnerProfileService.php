<?php

namespace App\Services;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Collection;

class OwnerService
{
    public function getAll(): Collection
    {
        return Owner::all();
    }

    public function find(Owner $owner): Owner
    {
        return $owner;
    }

    public function create(array $data): Owner
    {
        return Owner::create($data);
    }

    public function update(Owner $owner, array $data): Owner
    {
        $owner->update($data);
        return $owner->fresh();
    }

    public function delete(Owner $owner): void
    {
        $owner->delete();
    }
}
<?php

namespace App\Services;

use App\Models\BookingItem;
use Illuminate\Database\Eloquent\Collection;

class BookingServiceService
{
    public function getAll(): Collection
    {
        return BookingItem::all();
    }

    public function find(BookingItem $bookingItem): BookingItem
    {
        return $bookingItem;
    }

    public function create(array $data): BookingItem
    {
        return BookingItem::create($data);
    }

    public function update(BookingItem $bookingItem, array $data): BookingItem
    {
        $bookingItem->update($data);
        return $bookingItem->fresh();
    }

    public function delete(BookingItem $bookingItem): void
    {
        $bookingItem->delete();
    }
}

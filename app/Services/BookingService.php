<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;

class BookingService
{
    public function getAll(): Collection
    {
        return Booking::all();
    }

    public function find(Booking $booking): Booking
    {
        return $booking;
    }

    public function create(array $data): Booking
    {
        return Booking::create($data);
    }

    public function update(Booking $booking, array $data): Booking
    {
        $booking->update($data);
        return $booking->fresh();
    }

    public function delete(Booking $booking): void
    {
        $booking->delete();
    }
}
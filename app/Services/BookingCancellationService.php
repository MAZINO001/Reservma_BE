<?php

namespace App\Services;

use App\Models\BookingCancellation;
use Illuminate\Database\Eloquent\Collection;

class BookingCancellationService
{
    public function getAll(): Collection
    {
        return BookingCancellation::all();
    }

    public function find(BookingCancellation $bookingCancellation): BookingCancellation
    {
        return $bookingCancellation;
    }

    public function create(array $data): BookingCancellation
    {
        return BookingCancellation::create($data);
    }

    public function update(BookingCancellation $bookingCancellation, array $data): BookingCancellation
    {
        $bookingCancellation->update($data);
        return $bookingCancellation->fresh();
    }

    public function delete(BookingCancellation $bookingCancellation): void
    {
        $bookingCancellation->delete();
    }
}
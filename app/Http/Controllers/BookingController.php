<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Services\BookingService;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    public function __construct(
        protected BookingService $bookingService
    ) {}

    public function index(): JsonResponse
    {
        $bookings = $this->bookingService->getAll();
        return response()->json($bookings);
    }

    public function store(StoreBookingRequest $request): JsonResponse
    {
        $booking = $this->bookingService->create($request->validated());
        return response()->json($booking, 201);
    }

    public function show(Booking $booking): JsonResponse
    {
        return response()->json($this->bookingService->find($booking));
    }

    public function update(UpdateBookingRequest $request, Booking $booking): JsonResponse
    {
        $booking = $this->bookingService->update($booking, $request->validated());
        return response()->json($booking);
    }

    public function destroy(Booking $booking): JsonResponse
    {
        $this->bookingService->delete($booking);
        return response()->json(['message' => 'Booking deleted successfully']);
    }
}
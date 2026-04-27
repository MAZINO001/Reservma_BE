<?php

namespace App\Http\Controllers;

use App\Models\BookingCancellation;
use App\Services\BookingCancellationService;
use App\Http\Requests\StoreBookingCancellationRequest;
use App\Http\Requests\UpdateBookingCancellationRequest;
use Illuminate\Http\JsonResponse;

class BookingCancellationController extends Controller
{
    public function __construct(
        protected BookingCancellationService $bookingCancellationService
    ) {}

    public function index(): JsonResponse
    {
        $bookingCancellations = $this->bookingCancellationService->getAll();
        return response()->json($bookingCancellations);
    }

    public function store(StoreBookingCancellationRequest $request): JsonResponse
    {
        $bookingCancellation = $this->bookingCancellationService->create($request->validated());
        return response()->json($bookingCancellation, 201);
    }

    public function show(BookingCancellation $bookingCancellation): JsonResponse
    {
        return response()->json($this->bookingCancellationService->find($bookingCancellation));
    }

    public function update(UpdateBookingCancellationRequest $request, BookingCancellation $bookingCancellation): JsonResponse
    {
        $bookingCancellation = $this->bookingCancellationService->update($bookingCancellation, $request->validated());
        return response()->json($bookingCancellation);
    }

    public function destroy(BookingCancellation $bookingCancellation): JsonResponse
    {
        $this->bookingCancellationService->delete($bookingCancellation);
        return response()->json(['message' => 'BookingCancellation deleted successfully']);
    }
}
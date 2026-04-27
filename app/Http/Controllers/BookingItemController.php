<?php

namespace App\Http\Controllers;

use App\Models\BookingItem;
use App\Services\BookingServiceService;
use App\Http\Requests\StoreBookingServiceRequest;
use App\Http\Requests\UpdateBookingServiceRequest;
use Illuminate\Http\JsonResponse;

class BookingItemController extends Controller
{
    public function __construct(
        protected BookingServiceService $bookingServiceService
    ) {}

    public function index(): JsonResponse
    {
        $bookingServices = $this->bookingServiceService->getAll();
        return response()->json($bookingServices);
    }

    public function store(StoreBookingServiceRequest $request): JsonResponse
    {
        $bookingService = $this->bookingServiceService->create($request->validated());
        return response()->json($bookingService, 201);
    }

    public function show(BookingItem $bookingService): JsonResponse
    {
        return response()->json($this->bookingServiceService->find($bookingService));
    }

    public function update(UpdateBookingServiceRequest $request, BookingItem $bookingService): JsonResponse
    {
        $bookingService = $this->bookingServiceService->update($bookingService, $request->validated());
        return response()->json($bookingService);
    }

    public function destroy(BookingItem $bookingService): JsonResponse
    {
        $this->bookingServiceService->delete($bookingService);
        return response()->json(['message' => 'BookingService deleted successfully']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BusinessHour;
use App\Services\BusinessHourService;
use App\Http\Requests\StoreBusinessHourRequest;
use App\Http\Requests\UpdateBusinessHourRequest;
use Illuminate\Http\JsonResponse;

class BusinessHourController extends Controller
{
    public function __construct(
        protected BusinessHourService $businessHourService
    ) {}

    public function index(): JsonResponse
    {
        $businessHours = $this->businessHourService->getAll();
        return response()->json($businessHours);
    }

    public function store(StoreBusinessHourRequest $request): JsonResponse
    {
        $businessHour = $this->businessHourService->create($request->validated());
        return response()->json($businessHour, 201);
    }

    public function show(BusinessHour $businessHour): JsonResponse
    {
        return response()->json($this->businessHourService->find($businessHour));
    }

    public function update(UpdateBusinessHourRequest $request, BusinessHour $businessHour): JsonResponse
    {
        $businessHour = $this->businessHourService->update($businessHour, $request->validated());
        return response()->json($businessHour);
    }

    public function destroy(BusinessHour $businessHour): JsonResponse
    {
        $this->businessHourService->delete($businessHour);
        return response()->json(['message' => 'BusinessHour deleted successfully']);
    }
}
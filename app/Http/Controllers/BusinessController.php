<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Services\BusinessService;
use App\Http\Requests\StoreBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use Illuminate\Http\JsonResponse;

class BusinessController extends Controller
{
    public function __construct(
        protected BusinessService $businessService
    ) {}

    public function index(): JsonResponse
    {
        $businesses = $this->businessService->getAll();
        return response()->json($businesses);
    }

    public function store(StoreBusinessRequest $request): JsonResponse
    {
        $business = $this->businessService->create($request->validated());
        return response()->json($business, 201);
    }

    public function show(Business $business): JsonResponse
    {
        return response()->json($this->businessService->find($business));
    }

    public function update(UpdateBusinessRequest $request, Business $business): JsonResponse
    {
        $business = $this->businessService->update($business, $request->validated());
        return response()->json($business);
    }

    public function destroy(Business $business): JsonResponse
    {
        $this->businessService->delete($business);
        return response()->json(['message' => 'Business deleted successfully']);
    }
}
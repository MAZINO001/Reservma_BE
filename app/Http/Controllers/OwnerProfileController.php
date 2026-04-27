<?php

namespace App\Http\Controllers;

use App\Models\OwnerProfile;
use App\Services\OwnerService;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use Illuminate\Http\JsonResponse;

class OwnerProfileController extends Controller
{
    public function __construct(
        protected OwnerService $ownerService
    ) {}

    public function index(): JsonResponse
    {
        $owners = $this->ownerService->getAll();
        return response()->json($owners);
    }

    public function store(StoreOwnerRequest $request): JsonResponse
    {
        $owner = $this->ownerService->create($request->validated());
        return response()->json($owner, 201);
    }

    public function show(OwnerProfile $ownerProfile): JsonResponse
    {
        return response()->json($this->ownerService->find($ownerProfile));
    }

    public function update(UpdateOwnerRequest $request, OwnerProfile $ownerProfile): JsonResponse
    {
        $owner = $this->ownerService->update($ownerProfile, $request->validated());
        return response()->json($owner);
    }

    public function destroy(OwnerProfile $ownerProfile): JsonResponse
    {
        $this->ownerService->delete($ownerProfile);
        return response()->json(['message' => 'OwnerProfile deleted successfully']);
    }
}
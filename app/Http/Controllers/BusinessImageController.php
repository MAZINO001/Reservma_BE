<?php

namespace App\Http\Controllers;

use App\Models\BusinessImage;
use App\Services\BusinessImageService;
use App\Http\Requests\StoreBusinessImageRequest;
use App\Http\Requests\UpdateBusinessImageRequest;
use Illuminate\Http\JsonResponse;

class BusinessImageController extends Controller
{
    public function __construct(
        protected BusinessImageService $businessImageService
    ) {}

    public function index(): JsonResponse
    {
        $businessImages = $this->businessImageService->getAll();
        return response()->json($businessImages);
    }

    public function store(StoreBusinessImageRequest $request): JsonResponse
    {
        $businessImage = $this->businessImageService->create($request->validated());
        return response()->json($businessImage, 201);
    }

    public function show(BusinessImage $businessImage): JsonResponse
    {
        return response()->json($this->businessImageService->find($businessImage));
    }

    public function update(UpdateBusinessImageRequest $request, BusinessImage $businessImage): JsonResponse
    {
        $businessImage = $this->businessImageService->update($businessImage, $request->validated());
        return response()->json($businessImage);
    }

    public function destroy(BusinessImage $businessImage): JsonResponse
    {
        $this->businessImageService->delete($businessImage);
        return response()->json(['message' => 'BusinessImage deleted successfully']);
    }
}
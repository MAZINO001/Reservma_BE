<?php

namespace App\Http\Controllers;

use App\Models\ServiceImage;
use App\Services\ServiceImageService;
use App\Http\Requests\StoreServiceImageRequest;
use App\Http\Requests\UpdateServiceImageRequest;
use Illuminate\Http\JsonResponse;

class ServiceImageController extends Controller
{
    public function __construct(
        protected ServiceImageService $serviceImageService
    ) {}

    public function index(): JsonResponse
    {
        $serviceImages = $this->serviceImageService->getAll();
        return response()->json($serviceImages);
    }

    public function store(StoreServiceImageRequest $request): JsonResponse
    {
        $serviceImage = $this->serviceImageService->create($request->validated());
        return response()->json($serviceImage, 201);
    }

    public function show(ServiceImage $serviceImage): JsonResponse
    {
        return response()->json($this->serviceImageService->find($serviceImage));
    }

    public function update(UpdateServiceImageRequest $request, ServiceImage $serviceImage): JsonResponse
    {
        $serviceImage = $this->serviceImageService->update($serviceImage, $request->validated());
        return response()->json($serviceImage);
    }

    public function destroy(ServiceImage $serviceImage): JsonResponse
    {
        $this->serviceImageService->delete($serviceImage);
        return response()->json(['message' => 'ServiceImage deleted successfully']);
    }
}
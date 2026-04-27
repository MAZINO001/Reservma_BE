<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\ServiceService;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function __construct(
        protected ServiceService $serviceService
    ) {}

    public function index(): JsonResponse
    {
        $services = $this->serviceService->getAll();
        return response()->json($services);
    }

    public function store(StoreServiceRequest $request): JsonResponse
    {
        $service = $this->serviceService->create($request->validated());
        return response()->json($service, 201);
    }

    public function show(Service $service): JsonResponse
    {
        return response()->json($this->serviceService->find($service));
    }

    public function update(UpdateServiceRequest $request, Service $service): JsonResponse
    {
        $service = $this->serviceService->update($service, $request->validated());
        return response()->json($service);
    }

    public function destroy(Service $service): JsonResponse
    {
        $this->serviceService->delete($service);
        return response()->json(['message' => 'Service deleted successfully']);
    }
}
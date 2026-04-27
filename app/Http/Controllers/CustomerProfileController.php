<?php

namespace App\Http\Controllers;

use App\Models\CustomerProfile;
use App\Services\CustomerService;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\JsonResponse;

class CustomerProfileController extends Controller
{
    public function __construct(
        protected CustomerService $customerService
    ) {}

    public function index(): JsonResponse
    {
        $customers = $this->customerService->getAll();
        return response()->json($customers);
    }

    public function store(StoreCustomerRequest $request): JsonResponse
    {
        $customerProfile = $this->customerService->create($request->validated());
        return response()->json($customerProfile, 201);
    }

    public function show(CustomerProfile $customerProfile): JsonResponse
    {
        return response()->json($this->customerService->find($customerProfile));
    }

    public function update(UpdateCustomerRequest $request, CustomerProfile $customerProfile): JsonResponse
    {
        $customerProfile = $this->customerService->update($customerProfile, $request->validated());
        return response()->json($customerProfile);
    }

    public function destroy(CustomerProfile $customerProfile): JsonResponse
    {
        $this->customerService->delete($customerProfile);
        return response()->json(['message' => 'CustomerProfile deleted successfully']);
    }
}

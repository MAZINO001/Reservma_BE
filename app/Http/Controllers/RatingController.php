<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Services\RatingService;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use Illuminate\Http\JsonResponse;

class RatingController extends Controller
{
    public function __construct(
        protected RatingService $ratingService
    ) {}

    public function index(): JsonResponse
    {
        $ratings = $this->ratingService->getAll();
        return response()->json($ratings);
    }

    public function store(StoreRatingRequest $request): JsonResponse
    {
        $rating = $this->ratingService->create($request->validated());
        return response()->json($rating, 201);
    }

    public function show(Rating $rating): JsonResponse
    {
        return response()->json($this->ratingService->find($rating));
    }

    public function update(UpdateRatingRequest $request, Rating $rating): JsonResponse
    {
        $rating = $this->ratingService->update($rating, $request->validated());
        return response()->json($rating);
    }

    public function destroy(Rating $rating): JsonResponse
    {
        $this->ratingService->delete($rating);
        return response()->json(['message' => 'Rating deleted successfully']);
    }
}
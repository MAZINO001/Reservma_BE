<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Services\FavoriteService;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use Illuminate\Http\JsonResponse;

class FavoriteController extends Controller
{
    public function __construct(
        protected FavoriteService $favoriteService
    ) {}

    public function index(): JsonResponse
    {
        $favorites = $this->favoriteService->getAll();
        return response()->json($favorites);
    }

    public function store(StoreFavoriteRequest $request): JsonResponse
    {
        $favorite = $this->favoriteService->create($request->validated());
        return response()->json($favorite, 201);
    }

    public function show(Favorite $favorite): JsonResponse
    {
        return response()->json($this->favoriteService->find($favorite));
    }

    public function update(UpdateFavoriteRequest $request, Favorite $favorite): JsonResponse
    {
        $favorite = $this->favoriteService->update($favorite, $request->validated());
        return response()->json($favorite);
    }

    public function destroy(Favorite $favorite): JsonResponse
    {
        $this->favoriteService->delete($favorite);
        return response()->json(['message' => 'Favorite deleted successfully']);
    }
}
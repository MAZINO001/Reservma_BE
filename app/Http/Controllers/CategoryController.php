<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {
    }

    public function index(): JsonResponse
    {
        $categories = $this->categoryService->getAll();
        return response()->json(CategoryResource::collection($categories));
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = $this->categoryService->create($request->validated());
        return response()->json(
            new CategoryResource($category)
        );
    }

    public function show(Category $category): JsonResponse
    {
        $category = $this->categoryService->find($category);
        return response()->json(
            new CategoryResource($category)
        );
    }

    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $category = $this->categoryService->update($category, $request->validated());
        return response()->json(
            new CategoryResource($category)
        );
    }

    public function destroy(Category $category): JsonResponse
    {
        $this->categoryService->delete($category);
        return response()->json(['message' => 'Category deleted successfully']);
    }
}

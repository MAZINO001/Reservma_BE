<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});


Route::get("/categories", [CategoryController::class, "Index"]);
Route::get("/categories/{category}", [CategoryController::class, "show"]);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/categories', [CategoryController::class, "store"]);
    Route::put('/categories/{category}', [CategoryController::class, "update"]);
    Route::delete('/categories/{category}', [CategoryController::class, "delete"]);
});

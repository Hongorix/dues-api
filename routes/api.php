<?php

use App\Http\Controllers\Api\CollectionController;
use App\Http\Controllers\Api\ContributorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('collections', CollectionController::class);

Route::apiResource('collections.contributors', ContributorController::class)
    ->scoped();

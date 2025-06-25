<?php

use App\Http\Controllers\Api\ChoreController;
use App\Http\Controllers\Api\FamilyController;
use App\Http\Controllers\Api\FamilyMemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Family routes
Route::apiResource('families', FamilyController::class);

// Family member routes
Route::apiResource('family-members', FamilyMemberController::class);

// Chore routes
Route::apiResource('chores', ChoreController::class);
Route::patch('chores/{chore}/complete', [ChoreController::class, 'complete'])->name('chores.complete');

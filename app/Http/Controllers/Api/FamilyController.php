<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $families = Family::where('is_active', true)->get();

        return response()->json([
            'success' => true,
            'data' => $families
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'settings' => 'nullable|array',
        ]);

        $family = Family::create($validated);

        return response()->json([
            'success' => true,
            'data' => $family,
            'message' => 'Family created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family): JsonResponse
    {
        $family->load(['members', 'chores', 'meals', 'calendarEvents']);

        return response()->json([
            'success' => true,
            'data' => $family
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'settings' => 'nullable|array',
            'is_active' => 'sometimes|boolean',
        ]);

        $family->update($validated);

        return response()->json([
            'success' => true,
            'data' => $family,
            'message' => 'Family updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family): JsonResponse
    {
        $family->update(['is_active' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Family deactivated successfully'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FamilyMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FamilyMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $members = FamilyMember::with(['user', 'family'])
            ->where('is_active', true)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $members
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'family_id' => 'required|exists:families,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'role' => 'required|in:parent,child,guardian,other',
            'avatar' => 'nullable|string|max:255',
        ]);

        $member = FamilyMember::create($validated);

        return response()->json([
            'success' => true,
            'data' => $member->load(['user', 'family']),
            'message' => 'Family member added successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(FamilyMember $familyMember): JsonResponse
    {
        $familyMember->load(['user', 'family', 'chores', 'meals', 'weightLogs', 'calendarEvents']);

        return response()->json([
            'success' => true,
            'data' => $familyMember
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamilyMember $familyMember): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'nullable|email|max:255',
            'role' => 'sometimes|required|in:parent,child,guardian,other',
            'avatar' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        $familyMember->update($validated);

        return response()->json([
            'success' => true,
            'data' => $familyMember->load(['user', 'family']),
            'message' => 'Family member updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamilyMember $familyMember): JsonResponse
    {
        $familyMember->update(['is_active' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Family member deactivated successfully'
        ]);
    }
}

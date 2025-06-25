<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chore;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $chores = Chore::with(['family', 'assignedMember'])
            ->orderBy('due_date', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $chores
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'family_id' => 'required|exists:families,id',
            'assigned_to' => 'nullable|exists:family_members,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'frequency' => 'required|in:daily,weekly,monthly,once',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'points' => 'nullable|integer|min:0',
        ]);

        $chore = Chore::create($validated);

        return response()->json([
            'success' => true,
            'data' => $chore->load(['family', 'assignedMember']),
            'message' => 'Chore created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chore $chore): JsonResponse
    {
        $chore->load(['family', 'assignedMember']);

        return response()->json([
            'success' => true,
            'data' => $chore
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chore $chore): JsonResponse
    {
        $validated = $request->validate([
            'assigned_to' => 'nullable|exists:family_members,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'frequency' => 'sometimes|required|in:daily,weekly,monthly,once',
            'due_date' => 'nullable|date',
            'priority' => 'sometimes|required|in:low,medium,high',
            'status' => 'sometimes|required|in:pending,in_progress,completed,overdue',
            'points' => 'nullable|integer|min:0',
        ]);

        if (isset($validated['status']) && $validated['status'] === 'completed') {
            $validated['completed_at'] = now();
        }

        $chore->update($validated);

        return response()->json([
            'success' => true,
            'data' => $chore->load(['family', 'assignedMember']),
            'message' => 'Chore updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chore $chore): JsonResponse
    {
        $chore->delete();

        return response()->json([
            'success' => true,
            'message' => 'Chore deleted successfully'
        ]);
    }

    public function complete(Chore $chore): JsonResponse
    {
        $chore->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'data' => $chore->load(['family', 'assignedMember']),
            'message' => 'Chore marked as completed'
        ]);
    }
}

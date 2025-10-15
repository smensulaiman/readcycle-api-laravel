<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Swap;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class SwapController extends Controller
{

    public function index(): JsonResponse
    {
        $swaps = Swap::with(['bookRequested.user', 'bookOffered.user', 'requester'])->get();

        return response()->json([
            'status' => true,
            'data'   => $swaps
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'book_requested_id' => 'required|exists:books,id',
            'book_offered_id'   => 'required|exists:books,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['requester_id'] = $request->user()->id;

        // Check if user is trying to swap their own book
        $requestedBook = \App\Models\Book::find($data['book_requested_id']);
        $offeredBook = \App\Models\Book::find($data['book_offered_id']);

        if ($requestedBook->user_id === $data['requester_id']) {
            return response()->json([
                'status' => false,
                'message' => 'You cannot request to swap your own book.'
            ], 422);
        }

        if ($offeredBook->user_id !== $data['requester_id']) {
            return response()->json([
                'status' => false,
                'message' => 'You can only offer your own books for swap.'
            ], 422);
        }

        // Check if swap already exists
        $existingSwap = Swap::where('book_requested_id', $data['book_requested_id'])
            ->where('book_offered_id', $data['book_offered_id'])
            ->where('requester_id', $data['requester_id'])
            ->where('status', 'pending')
            ->first();

        if ($existingSwap) {
            return response()->json([
                'status' => false,
                'message' => 'You already have a pending swap request for these books.'
            ], 422);
        }

        $swap = Swap::create($data);
        $swap->load(['bookRequested.user', 'bookOffered.user', 'requester']);

        return response()->json([
            'status'  => true,
            'message' => 'Swap request sent successfully.',
            'data'    => $swap,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Swap $swap): JsonResponse
    {
        // Check authorization
        if (!Gate::allows('view', $swap)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to view this swap'
            ], 403);
        }

        $swap->load(['bookRequested.user', 'bookOffered.user', 'requester']);

        return response()->json([
            'status' => true,
            'message' => 'Swap retrieved successfully',
            'data' => $swap
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Swap $swap): JsonResponse
    {
        // Check authorization
        if (!Gate::allows('update', $swap)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to update this swap'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'book_requested_id' => 'sometimes|required|exists:books,id',
            'book_offered_id'   => 'sometimes|required|exists:books,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Only allow updates if status is pending
        if ($swap->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Cannot update swap that is not pending'
            ], 422);
        }

        $swap->update($validator->validated());
        $swap->load(['bookRequested.user', 'bookOffered.user', 'requester']);

        return response()->json([
            'status'  => true,
            'message' => 'Swap updated successfully.',
            'data'    => $swap,
        ]);
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'swap_id' => 'required|exists:swaps,id',
            'status' => 'required|string|in:pending,accepted,declined',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $swap = Swap::find($request->input('swap_id'));

        // Check authorization
        if (!Gate::allows('updateStatus', $swap)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to update swap status'
            ], 403);
        }

        $swap->status = $request->input('status');
        $swap->save();
        $swap->load(['bookRequested.user', 'bookOffered.user', 'requester']);

        return response()->json([
            'status'  => true,
            'message' => 'Swap status updated successfully',
            'data' => $swap
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Swap $swap): JsonResponse
    {
        // Check authorization
        if (!Gate::allows('delete', $swap)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to delete this swap'
            ], 403);
        }

        // Only allow deletion if status is pending
        if ($swap->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete swap that is not pending'
            ], 422);
        }

        $swap->delete();

        return response()->json([
            'status' => true,
            'message' => 'Swap request cancelled successfully'
        ]);
    }
}

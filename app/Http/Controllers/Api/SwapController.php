<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Swap;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'requester_id'      => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $swap = Swap::create($validator->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Swap request sent successfully.',
            'data'    => $swap,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Swap $swap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Swap $swap)
    {
        //
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'swap_id' => 'required|exists:swaps,id',
            'status' => 'required|string|in:pending,accepted,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $swap = Swap::find($request->input('swap_id'));
        $swap->status = $request->input('status');
        $swap->save();

        return response()->json([
            'status'  => true,
            'message' => 'Swap status updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Swap $swap)
    {
        //
    }
}

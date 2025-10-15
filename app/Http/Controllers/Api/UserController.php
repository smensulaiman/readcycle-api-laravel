<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = User::with(['books'])
            ->latest()
            ->paginate(15);

        return response()->json([
            'status' => true,
            'message' => 'Users retrieved successfully',
            'data' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        // Users cannot create other users through this endpoint
        // Registration is handled by AuthController
        return response()->json([
            'status' => false,
            'message' => 'User creation not allowed through this endpoint. Use registration endpoint.'
        ], 405);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        $user->load(['books.category']);

        return response()->json([
            'status' => true,
            'message' => 'User profile retrieved successfully',
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): JsonResponse
    {
        // Check authorization
        if (!Gate::allows('update', $user)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to update this profile'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'university_name' => 'sometimes|required|string|max:255',
            'department' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:50',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:6',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Handle password hashing
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            try {
                $data['profile_picture'] = $this->fileUploadService->updateProfilePicture(
                    $request->file('profile_picture'),
                    $user->profile_picture
                );
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Profile picture upload failed: ' . $e->getMessage()
                ], 422);
            }
        }

        $user->update($data);

        return response()->json([
            'status'  => true,
            'message' => 'Profile updated successfully',
            'data'    => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        // Check authorization
        if (!Gate::allows('delete', $user)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to delete this account'
            ], 403);
        }

        // Delete associated profile picture
        if ($user->profile_picture) {
            $this->fileUploadService->deleteImage($user->profile_picture);
        }

        // Delete user's books and their images
        foreach ($user->books as $book) {
            if ($book->photo_path) {
                $this->fileUploadService->deleteImage($book->photo_path);
            }
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Account deleted successfully'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\FileUploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
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
        $books = Book::with(['user', 'category'])
            ->latest()
            ->paginate(15);

        return response()->json([
            'status' => true,
            'message' => 'Books retrieved successfully',
            'data' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_url'   => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['user_id'] = $request->user()->id;

        // Handle image - either file upload or URL
        if ($request->hasFile('photo')) {
            try {
                $data['photo_path'] = $this->fileUploadService->uploadBookImage($request->file('photo'));
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Image upload failed: ' . $e->getMessage()
                ], 422);
            }
        } elseif ($request->filled('photo_url')) {
            $data['photo_path'] = $request->input('photo_url');
        }

        $book = Book::create($data);
        $book->load(['user', 'category']);

        return response()->json([
            'status'  => true,
            'message' => 'Book added successfully',
            'data'    => $book,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): JsonResponse
    {
        $book->load(['user', 'category']);

        return response()->json([
            'status' => true,
            'message' => 'Book retrieved successfully',
            'data' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): JsonResponse
    {
        // Check authorization
        if (!Gate::allows('update', $book)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to update this book'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'category_id' => 'sometimes|required|exists:categories,id',
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_url'   => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Handle image - either file upload or URL
        if ($request->hasFile('photo')) {
            try {
                $data['photo_path'] = $this->fileUploadService->updateBookImage(
                    $request->file('photo'),
                    $book->photo_path
                );
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Image upload failed: ' . $e->getMessage()
                ], 422);
            }
        } elseif ($request->filled('photo_url')) {
            $data['photo_path'] = $request->input('photo_url');
        }

        $book->update($data);
        $book->load(['user', 'category']);

        return response()->json([
            'status'  => true,
            'message' => 'Book updated successfully',
            'data'    => $book,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): JsonResponse
    {
        // Check authorization
        if (!Gate::allows('delete', $book)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized to delete this book'
            ], 403);
        }

        // Delete associated image file
        if ($book->photo_path) {
            $this->fileUploadService->deleteImage($book->photo_path);
        }

        $book->delete();

        return response()->json([
            'status' => true,
            'message' => 'Book deleted successfully'
        ]);
    }

    public function getBooksByCategory($id): JsonResponse
    {
        $books = Book::with('user', 'category')
            ->where('category_id', $id)
            ->latest()
            ->get();

        return response()->json($books);
    }
}

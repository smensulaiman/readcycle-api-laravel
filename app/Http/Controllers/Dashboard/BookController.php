<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function index()
    {
        $books = Book::where('user_id', Auth::id())
            ->with('category')
            ->latest()
            ->paginate(12);

        return view('dashboard.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        $data['user_id'] = Auth::id();

        // Handle image - either file upload or URL
        if ($request->hasFile('photo')) {
            try {
                $data['photo_path'] = $this->fileUploadService->uploadBookImage($request->file('photo'));
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withErrors(['photo' => 'Image upload failed: ' . $e->getMessage()])
                    ->withInput();
            }
        } elseif ($request->filled('photo_url')) {
            $data['photo_path'] = $request->input('photo_url');
        }

        $book = Book::create($data);

        return redirect()->route('dashboard.books.index')
            ->with('success', 'Book added successfully!');
    }

    public function show(Book $book)
    {
        if (!Gate::allows('view', $book)) {
            abort(403);
        }

        $book->load(['category', 'user', 'swaps.bookOffered.user', 'swaps.requester']);
        
        return view('dashboard.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        if (!Gate::allows('update', $book)) {
            abort(403);
        }

        $categories = Category::all();
        return view('dashboard.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        if (!Gate::allows('update', $book)) {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
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
                return redirect()->back()
                    ->withErrors(['photo' => 'Image upload failed: ' . $e->getMessage()])
                    ->withInput();
            }
        } elseif ($request->filled('photo_url')) {
            $data['photo_path'] = $request->input('photo_url');
        }

        $book->update($data);

        return redirect()->route('dashboard.books.index')
            ->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        if (!Gate::allows('delete', $book)) {
            abort(403);
        }

        // Delete associated image file
        if ($book->photo_path) {
            $this->fileUploadService->deleteImage($book->photo_path);
        }

        $book->delete();

        return redirect()->route('dashboard.books.index')
            ->with('success', 'Book deleted successfully!');
    }
}

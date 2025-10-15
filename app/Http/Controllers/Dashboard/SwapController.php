<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Swap;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SwapController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get swaps where user is requester
        $sentSwaps = Swap::where('requester_id', $user->id)
            ->with(['bookRequested.user', 'bookOffered.user'])
            ->latest()
            ->paginate(10, ['*'], 'sent_page');
        
        // Get swaps where user's books are requested
        $receivedSwaps = Swap::whereHas('bookRequested', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with(['bookRequested.user', 'bookOffered.user', 'requester'])
            ->latest()
            ->paginate(10, ['*'], 'received_page');
        
        return view('dashboard.swaps.index', compact('sentSwaps', 'receivedSwaps'));
    }

    public function create()
    {
        // Get all books that don't belong to the current user
        $availableBooks = Book::where('user_id', '!=', Auth::id())
            ->with(['user', 'category'])
            ->latest()
            ->get();
        
        // Get user's books
        $userBooks = Book::where('user_id', Auth::id())
            ->with('category')
            ->latest()
            ->get();
        
        return view('dashboard.swaps.create', compact('availableBooks', 'userBooks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_requested_id' => 'required|exists:books,id',
            'book_offered_id' => 'required|exists:books,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        $data['requester_id'] = Auth::id();

        // Check if user is trying to swap their own book
        $requestedBook = Book::find($data['book_requested_id']);
        $offeredBook = Book::find($data['book_offered_id']);

        if ($requestedBook->user_id === $data['requester_id']) {
            return redirect()->back()
                ->withErrors(['book_requested_id' => 'You cannot request to swap your own book.'])
                ->withInput();
        }

        if ($offeredBook->user_id !== $data['requester_id']) {
            return redirect()->back()
                ->withErrors(['book_offered_id' => 'You can only offer your own books for swap.'])
                ->withInput();
        }

        // Check if swap already exists
        $existingSwap = Swap::where('book_requested_id', $data['book_requested_id'])
            ->where('book_offered_id', $data['book_offered_id'])
            ->where('requester_id', $data['requester_id'])
            ->where('status', 'pending')
            ->first();

        if ($existingSwap) {
            return redirect()->back()
                ->withErrors(['book_requested_id' => 'You already have a pending swap request for these books.'])
                ->withInput();
        }

        $swap = Swap::create($data);

        return redirect()->route('dashboard.swaps.index')
            ->with('success', 'Swap request sent successfully!');
    }

    public function show(Swap $swap)
    {
        // Check authorization
        if (!Gate::allows('view', $swap)) {
            abort(403);
        }

        $swap->load(['bookRequested.user', 'bookOffered.user', 'requester']);
        
        return view('dashboard.swaps.show', compact('swap'));
    }

    public function edit(Swap $swap)
    {
        // Check authorization
        if (!Gate::allows('update', $swap)) {
            abort(403);
        }

        // Only allow editing if status is pending
        if ($swap->status !== 'pending') {
            return redirect()->route('dashboard.swaps.show', $swap)
                ->with('error', 'Cannot edit swap that is not pending.');
        }

        // Get all books that don't belong to the current user
        $availableBooks = Book::where('user_id', '!=', Auth::id())
            ->with(['user', 'category'])
            ->latest()
            ->get();
        
        // Get user's books
        $userBooks = Book::where('user_id', Auth::id())
            ->with('category')
            ->latest()
            ->get();
        
        return view('dashboard.swaps.edit', compact('swap', 'availableBooks', 'userBooks'));
    }

    public function update(Request $request, Swap $swap)
    {
        // Check authorization
        if (!Gate::allows('update', $swap)) {
            abort(403);
        }

        // Only allow updates if status is pending
        if ($swap->status !== 'pending') {
            return redirect()->route('dashboard.swaps.show', $swap)
                ->with('error', 'Cannot update swap that is not pending.');
        }

        $validator = Validator::make($request->all(), [
            'book_requested_id' => 'required|exists:books,id',
            'book_offered_id' => 'required|exists:books,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        // Check if user is trying to swap their own book
        $requestedBook = Book::find($data['book_requested_id']);
        $offeredBook = Book::find($data['book_offered_id']);

        if ($requestedBook->user_id === Auth::id()) {
            return redirect()->back()
                ->withErrors(['book_requested_id' => 'You cannot request to swap your own book.'])
                ->withInput();
        }

        if ($offeredBook->user_id !== Auth::id()) {
            return redirect()->back()
                ->withErrors(['book_offered_id' => 'You can only offer your own books for swap.'])
                ->withInput();
        }

        $swap->update($data);

        return redirect()->route('dashboard.swaps.index')
            ->with('success', 'Swap request updated successfully!');
    }

    public function destroy(Swap $swap)
    {
        // Check authorization
        if (!Gate::allows('delete', $swap)) {
            abort(403);
        }

        // Only allow deletion if status is pending
        if ($swap->status !== 'pending') {
            return redirect()->route('dashboard.swaps.index')
                ->with('error', 'Cannot delete swap that is not pending.');
        }

        $swap->delete();

        return redirect()->route('dashboard.swaps.index')
            ->with('success', 'Swap request cancelled successfully!');
    }

    public function updateStatus(Request $request, Swap $swap)
    {
        // Check authorization
        if (!Gate::allows('updateStatus', $swap)) {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:pending,accepted,declined',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        $swap->status = $request->input('status');
        $swap->save();

        $statusMessage = $swap->status === 'accepted' ? 'accepted' : 'declined';
        
        return redirect()->route('dashboard.swaps.index')
            ->with('success', "Swap request {$statusMessage} successfully!");
    }
}

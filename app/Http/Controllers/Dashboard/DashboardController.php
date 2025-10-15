<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Swap;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get user's books
        $userBooks = Book::where('user_id', $user->id)
            ->with('category')
            ->latest()
            ->take(5)
            ->get();
        
        // Get user's swap requests (as requester)
        $userSwaps = Swap::where('requester_id', $user->id)
            ->with(['bookRequested.user', 'bookOffered.user'])
            ->latest()
            ->take(5)
            ->get();
        
        // Get swap requests for user's books (as book owner)
        $receivedSwaps = Swap::whereHas('bookRequested', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with(['bookRequested.user', 'bookOffered.user', 'requester'])
            ->latest()
            ->take(5)
            ->get();
        
        // Get statistics
        $stats = [
            'total_books' => Book::where('user_id', $user->id)->count(),
            'total_swaps_sent' => Swap::where('requester_id', $user->id)->count(),
            'total_swaps_received' => Swap::whereHas('bookRequested', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count(),
            'pending_swaps' => Swap::whereHas('bookRequested', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('status', 'pending')->count(),
            'accepted_swaps' => Swap::whereHas('bookRequested', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('status', 'accepted')->count(),
            'declined_swaps' => Swap::whereHas('bookRequested', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('status', 'declined')->count(),
        ];
        
        // Get category statistics for charts
        $categoryStats = Category::withCount('books')
            ->having('books_count', '>', 0)
            ->orderBy('books_count', 'desc')
            ->get();
        
        return view('dashboard.index', compact('user', 'userBooks', 'userSwaps', 'receivedSwaps', 'stats', 'categoryStats'));
    }
}

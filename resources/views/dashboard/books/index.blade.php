@extends('layouts.dashboard')

@section('title', 'আমার বই')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1 bangla-font">আমার বই</h2>
                    <p class="text-muted mb-0 bangla-font">আপনার বইয়ের সংগ্রহ পরিচালনা করুন</p>
                </div>
                <a href="{{ route('dashboard.books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i><span class="bangla-font">নতুন বই যোগ করুন</span>
                </a>
            </div>
        </div>
    </div>

    @if($books->count() > 0)
        <!-- Books Grid -->
        <div class="row">
            @foreach($books as $book)
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 book-card">
                        @if($book->photo_path)
                            <img src="{{ $book->photo_path }}" 
                                 class="card-img-top book-cover" 
                                 alt="{{ $book->title }}">
                        @else
                            <div class="card-img-top book-cover bg-light d-flex align-items-center justify-content-center">
                                <i class="fas fa-book fa-3x text-muted"></i>
                            </div>
                        @endif
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted small">{{ $book->category->name }}</p>
                            @if($book->description)
                                <p class="card-text small">{{ Str::limit($book->description, 100) }}</p>
                            @endif
                            
                            <div class="mt-auto">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('dashboard.books.show', $book) }}" 
                                       class="btn btn-outline btn-sm flex-fill">
                                        <i class="fas fa-eye me-1"></i><span class="bangla-font">দেখুন</span>
                                    </a>
                                    <a href="{{ route('dashboard.books.edit', $book) }}" 
                                       class="btn btn-primary btn-sm flex-fill">
                                        <i class="fas fa-edit me-1"></i><span class="bangla-font">সম্পাদনা</span>
                                    </a>
                                </div>
                                
                                <div class="mt-2">
                                    <form method="POST" action="{{ route('dashboard.books.destroy', $book) }}" 
                                          class="d-inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this book?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline btn-sm w-100 text-danger">
                                            <i class="fas fa-trash me-1"></i><span class="bangla-font">মুছে ফেলুন</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-transparent">
                            <small class="text-muted bangla-font">
                                <i class="fas fa-clock me-1"></i>
                                যোগ করা হয়েছে {{ $book->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-book fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted mb-3 bangla-font">এখনো কোনো বই নেই</h4>
                        <p class="text-muted mb-4 bangla-font">আপনার প্রথম বই যোগ করে আপনার বইয়ের সংগ্রহ গড়ে তুলুন।</p>
                        <a href="{{ route('dashboard.books.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i><span class="bangla-font">আপনার প্রথম বই যোগ করুন</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

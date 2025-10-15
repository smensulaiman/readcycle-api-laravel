@extends('layouts.dashboard')

@section('title', $category->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">{{ $category->name }}</h5>
                        <p class="text-muted mb-0">{{ $category->books->count() }} books in this category</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.categories.edit', $category) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Category
                        </a>
                        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-outline">
                            <i class="fas fa-arrow-left me-2"></i>Back to Categories
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($category->books->count() > 0)
                        <div class="row">
                            @foreach($category->books as $book)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100">
                                        @if($book->photo_path)
                                            <img src="{{ $book->photo_path }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $book->title }}"
                                                 style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                                 style="height: 200px;">
                                                <i class="fas fa-book fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title">{{ $book->title }}</h6>
                                            <p class="card-text text-muted small">by {{ $book->user->name }}</p>
                                            @if($book->description)
                                                <p class="card-text small">{{ Str::limit($book->description, 100) }}</p>
                                            @endif
                                            
                                            <div class="mt-auto">
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('dashboard.books.show', $book) }}" 
                                                       class="btn btn-outline btn-sm flex-fill">
                                                        <i class="fas fa-eye me-1"></i>View
                                                    </a>
                                                    @if($book->user_id === Auth::id())
                                                        <a href="{{ route('dashboard.books.edit', $book) }}" 
                                                           class="btn btn-primary btn-sm flex-fill">
                                                            <i class="fas fa-edit me-1"></i>Edit
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card-footer bg-transparent">
                                            <small class="text-muted">
                                                <i class="fas fa-user me-1"></i>
                                                {{ $book->user->name }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-book fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted mb-3">No books in this category</h4>
                            <p class="text-muted mb-4">This category doesn't have any books yet.</p>
                            <a href="{{ route('dashboard.books.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add a Book
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

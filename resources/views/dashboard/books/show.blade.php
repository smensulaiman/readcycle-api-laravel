@extends('layouts.dashboard')

@section('title', $book->title)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($book->photo_path)
                                <img src="{{ $book->photo_path }}" 
                                     class="img-fluid rounded" 
                                     alt="{{ $book->title }}">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="height: 300px;">
                                    <i class="fas fa-book fa-4x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h2 class="mb-3">{{ $book->title }}</h2>
                            <p class="text-muted mb-3">
                                <i class="fas fa-tag me-2"></i>{{ $book->category->name }}
                            </p>
                            @if($book->description)
                                <p class="mb-4">{{ $book->description }}</p>
                            @endif
                            <div class="d-flex gap-2">
                                <a href="{{ route('dashboard.books.edit', $book) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i>Edit Book
                                </a>
                                <form method="POST" action="{{ route('dashboard.books.destroy', $book) }}" 
                                      class="d-inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this book?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline text-danger">
                                        <i class="fas fa-trash me-2"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Book Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Added:</strong><br>
                        <span class="text-muted">{{ $book->created_at->format('F d, Y') }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Last Updated:</strong><br>
                        <span class="text-muted">{{ $book->updated_at->format('F d, Y') }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Swap Requests:</strong><br>
                        <span class="badge badge-primary">{{ $book->swaps->count() }}</span>
                    </div>
                </div>
            </div>
            
            @if($book->swaps->count() > 0)
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Swap Requests</h5>
                </div>
                <div class="card-body">
                    @foreach($book->swaps->take(3) as $swap)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <small class="text-muted">{{ $swap->requester->name }}</small><br>
                                <small>Wants: {{ $swap->bookOffered->title }}</small>
                            </div>
                            <span class="badge badge-warning">{{ ucfirst($swap->status) }}</span>
                        </div>
                        @if(!$loop->last)
                            <hr class="my-2">
                        @endif
                    @endforeach
                    @if($book->swaps->count() > 3)
                        <div class="text-center mt-3">
                            <a href="{{ route('dashboard.swaps.index') }}" class="btn btn-outline btn-sm">
                                View All Requests
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

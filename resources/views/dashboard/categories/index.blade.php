@extends('layouts.dashboard')

@section('title', 'Categories')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">Categories</h2>
                    <p class="text-muted mb-0">Manage book categories</p>
                </div>
                <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Category
                </a>
            </div>
        </div>
    </div>

    @if($categories->count() > 0)
        <!-- Categories Grid -->
        <div class="row">
            @foreach($categories as $category)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-tag fa-2x text-white"></i>
                                </div>
                            </div>
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="text-muted mb-3">{{ $category->books_count }} books</p>
                            
                            <div class="d-flex gap-2">
                                <a href="{{ route('dashboard.categories.show', $category) }}" 
                                   class="btn btn-outline btn-sm flex-fill">
                                    <i class="fas fa-eye me-1"></i>View
                                </a>
                                <a href="{{ route('dashboard.categories.edit', $category) }}" 
                                   class="btn btn-primary btn-sm flex-fill">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                            </div>
                            
                            <div class="mt-2">
                                <form method="POST" action="{{ route('dashboard.categories.destroy', $category) }}" 
                                      class="d-inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-sm w-100 text-danger">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-tags fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted mb-3">No categories yet</h4>
                        <p class="text-muted mb-4">Start by creating your first category for organizing books.</p>
                        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Create First Category
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

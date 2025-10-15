@extends('layouts.dashboard')

@section('title', 'Request Swap')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Request Book Swap</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.swaps.store') }}">
                        @csrf
                        
                        <div class="row">
                            <!-- Book You Want -->
                            <div class="col-lg-6 mb-4">
                                <h6 class="mb-3">Book You Want</h6>
                                <div class="form-group">
                                    <label for="book_requested_id" class="form-label">Select Book <span class="text-danger">*</span></label>
                                    <select class="form-control @error('book_requested_id') is-invalid @enderror" 
                                            id="book_requested_id" 
                                            name="book_requested_id" 
                                            required>
                                        <option value="">Choose a book you want...</option>
                                        @foreach($availableBooks as $book)
                                            <option value="{{ $book->id }}" 
                                                    {{ old('book_requested_id') == $book->id ? 'selected' : '' }}
                                                    data-title="{{ $book->title }}"
                                                    data-category="{{ $book->category->name }}"
                                                    data-owner="{{ $book->user->name }}"
                                                    data-image="{{ $book->photo_path ? $book->photo_path : '' }}">
                                                {{ $book->title }} - {{ $book->user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('book_requested_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Selected Book Preview -->
                                <div id="requestedBookPreview" class="mt-3" style="display: none;">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <img id="requestedBookImage" src="" alt="" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                                </div>
                                                <div class="col-8">
                                                    <h6 id="requestedBookTitle" class="mb-1"></h6>
                                                    <p id="requestedBookCategory" class="text-muted small mb-1"></p>
                                                    <p id="requestedBookOwner" class="text-muted small mb-0"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Book You Offer -->
                            <div class="col-lg-6 mb-4">
                                <h6 class="mb-3">Book You Offer</h6>
                                <div class="form-group">
                                    <label for="book_offered_id" class="form-label">Select Your Book <span class="text-danger">*</span></label>
                                    <select class="form-control @error('book_offered_id') is-invalid @enderror" 
                                            id="book_offered_id" 
                                            name="book_offered_id" 
                                            required>
                                        <option value="">Choose a book to offer...</option>
                                        @foreach($userBooks as $book)
                                            <option value="{{ $book->id }}" 
                                                    {{ old('book_offered_id') == $book->id ? 'selected' : '' }}
                                                    data-title="{{ $book->title }}"
                                                    data-category="{{ $book->category->name }}"
                                                    data-image="{{ $book->photo_path ? $book->photo_path : '' }}">
                                                {{ $book->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('book_offered_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Selected Book Preview -->
                                <div id="offeredBookPreview" class="mt-3" style="display: none;">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <img id="offeredBookImage" src="" alt="" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                                </div>
                                                <div class="col-8">
                                                    <h6 id="offeredBookTitle" class="mb-1"></h6>
                                                    <p id="offeredBookCategory" class="text-muted small mb-0"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if($userBooks->count() === 0)
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                You need to add books to your collection before you can request swaps.
                                <a href="{{ route('dashboard.books.create') }}" class="alert-link">Add your first book</a>
                            </div>
                        @endif
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" {{ $userBooks->count() === 0 ? 'disabled' : '' }}>
                                <i class="fas fa-paper-plane me-2"></i>Send Swap Request
                            </button>
                            <a href="{{ route('dashboard.swaps.index') }}" class="btn btn-outline">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Book selection preview functionality
    document.getElementById('book_requested_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const preview = document.getElementById('requestedBookPreview');
        
        if (this.value) {
            document.getElementById('requestedBookTitle').textContent = selectedOption.dataset.title;
            document.getElementById('requestedBookCategory').textContent = selectedOption.dataset.category;
            document.getElementById('requestedBookOwner').textContent = 'Owner: ' + selectedOption.dataset.owner;
            
            const image = document.getElementById('requestedBookImage');
            if (selectedOption.dataset.image) {
                image.src = selectedOption.dataset.image;
                image.style.display = 'block';
            } else {
                image.style.display = 'none';
            }
            
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });
    
    document.getElementById('book_offered_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const preview = document.getElementById('offeredBookPreview');
        
        if (this.value) {
            document.getElementById('offeredBookTitle').textContent = selectedOption.dataset.title;
            document.getElementById('offeredBookCategory').textContent = selectedOption.dataset.category;
            
            const image = document.getElementById('offeredBookImage');
            if (selectedOption.dataset.image) {
                image.src = selectedOption.dataset.image;
                image.style.display = 'block';
            } else {
                image.style.display = 'none';
            }
            
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endpush
@endsection

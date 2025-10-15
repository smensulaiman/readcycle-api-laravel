@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <!-- Profile Card -->
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                                 class="rounded-circle" 
                                 alt="{{ $user->name }}"
                                 style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                                 style="width: 120px; height: 120px;">
                                <i class="fas fa-user fa-3x text-white"></i>
                            </div>
                        @endif
                    </div>
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-2">{{ $user->university_name }}</p>
                    @if($user->department)
                        <p class="text-muted mb-2">{{ $user->department }}</p>
                    @endif
                    @if($user->year)
                        <p class="text-muted mb-0">{{ $user->year }} Year</p>
                    @endif
                </div>
            </div>
            
            <!-- Statistics Card -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h4 class="text-primary mb-1">{{ $user->books->count() }}</h4>
                            <p class="text-muted small mb-0">Books</p>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success mb-1">0</h4>
                            <p class="text-muted small mb-0">Swaps</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <!-- Profile Form -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="university_name" class="form-label">University <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('university_name') is-invalid @enderror" 
                                       id="university_name" 
                                       name="university_name" 
                                       value="{{ old('university_name', $user->university_name) }}" 
                                       required>
                                @error('university_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" 
                                       class="form-control @error('department') is-invalid @enderror" 
                                       id="department" 
                                       name="department" 
                                       value="{{ old('department', $user->department) }}">
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="year" class="form-label">Academic Year</label>
                                <select class="form-control @error('year') is-invalid @enderror" 
                                        id="year" 
                                        name="year">
                                    <option value="">Select Year</option>
                                    <option value="1st" {{ old('year', $user->year) == '1st' ? 'selected' : '' }}>1st Year</option>
                                    <option value="2nd" {{ old('year', $user->year) == '2nd' ? 'selected' : '' }}>2nd Year</option>
                                    <option value="3rd" {{ old('year', $user->year) == '3rd' ? 'selected' : '' }}>3rd Year</option>
                                    <option value="4th" {{ old('year', $user->year) == '4th' ? 'selected' : '' }}>4th Year</option>
                                    <option value="Graduate" {{ old('year', $user->year) == 'Graduate' ? 'selected' : '' }}>Graduate</option>
                                </select>
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" 
                                       class="form-control @error('profile_picture') is-invalid @enderror" 
                                       id="profile_picture" 
                                       name="profile_picture" 
                                       accept="image/*">
                                <div class="form-text">Upload a profile picture (JPG, PNG, GIF - Max 1MB)</div>
                                @error('profile_picture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                <!-- Image Preview -->
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password">
                                <div class="form-text">Leave blank to keep current password</div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" 
                                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                                       id="password_confirmation" 
                                       name="password_confirmation">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                            <a href="{{ route('dashboard.index') }}" class="btn btn-outline">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- My Books Section -->
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">My Books</h5>
                    <a href="{{ route('dashboard.books.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>Add Book
                    </a>
                </div>
                <div class="card-body">
                    @if($user->books->count() > 0)
                        <div class="row">
                            @foreach($user->books->take(8) as $book)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                    <div class="card">
                                        @if($book->photo_path)
                                            <img src="{{ $book->photo_path }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $book->title }}"
                                                 style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                                 style="height: 200px;">
                                                <i class="fas fa-book fa-2x text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="card-body p-2">
                                            <h6 class="card-title mb-1 small">{{ Str::limit($book->title, 15) }}</h6>
                                            <p class="text-muted small mb-2">{{ Str::limit($book->category->name, 12) }}</p>
                                            <a href="{{ route('dashboard.books.show', $book) }}" class="btn btn-outline btn-sm w-100">
                                                View
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($user->books->count() > 8)
                            <div class="text-center mt-3">
                                <a href="{{ route('dashboard.books.index') }}" class="btn btn-outline">View All Books</a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-book fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">No books yet</h6>
                            <p class="text-muted mb-3">Start by adding your first book to the platform.</p>
                            <a href="{{ route('dashboard.books.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add Your First Book
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Image preview functionality
    document.getElementById('profile_picture').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreview').style.display = 'none';
        }
    });
</script>
@endpush
@endsection

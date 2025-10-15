@extends('layouts.dashboard')

@section('title', 'Swap Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Swap Details</h5>
                    <span class="badge badge-{{ $swap->status === 'pending' ? 'warning' : ($swap->status === 'accepted' ? 'success' : 'danger') }}">
                        {{ ucfirst($swap->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Book Requested -->
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Book Requested</h6>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            @if($swap->bookRequested->photo_path)
                                                <img src="{{ $swap->bookRequested->photo_path }}" 
                                                     class="img-thumbnail" 
                                                     alt="{{ $swap->bookRequested->title }}"
                                                     style="width: 100px; height: 100px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 100px; height: 100px;">
                                                    <i class="fas fa-book fa-2x text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mb-1">{{ $swap->bookRequested->title }}</h6>
                                            <p class="text-muted small mb-1">{{ $swap->bookRequested->category->name }}</p>
                                            <p class="text-muted small mb-0">
                                                <strong>Owner:</strong> {{ $swap->bookRequested->user->name }}
                                            </p>
                                            @if($swap->bookRequested->description)
                                                <p class="small mt-2">{{ Str::limit($swap->bookRequested->description, 100) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Book Offered -->
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Book Offered</h6>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            @if($swap->bookOffered->photo_path)
                                                <img src="{{ $swap->bookOffered->photo_path }}" 
                                                     class="img-thumbnail" 
                                                     alt="{{ $swap->bookOffered->title }}"
                                                     style="width: 100px; height: 100px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 100px; height: 100px;">
                                                    <i class="fas fa-book fa-2x text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mb-1">{{ $swap->bookOffered->title }}</h6>
                                            <p class="text-muted small mb-1">{{ $swap->bookOffered->category->name }}</p>
                                            <p class="text-muted small mb-0">
                                                <strong>Owner:</strong> {{ $swap->bookOffered->user->name }}
                                            </p>
                                            @if($swap->bookOffered->description)
                                                <p class="small mt-2">{{ Str::limit($swap->bookOffered->description, 100) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Swap Information -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6 class="text-muted mb-3">Swap Information</h6>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-2">
                                                <strong>Requested by:</strong> {{ $swap->requester->name }}
                                            </p>
                                            <p class="mb-2">
                                                <strong>Requested on:</strong> {{ $swap->created_at->format('F d, Y \a\t g:i A') }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-2">
                                                <strong>Status:</strong> 
                                                <span class="badge badge-{{ $swap->status === 'pending' ? 'warning' : ($swap->status === 'accepted' ? 'success' : 'danger') }}">
                                                    {{ ucfirst($swap->status) }}
                                                </span>
                                            </p>
                                            @if($swap->updated_at != $swap->created_at)
                                                <p class="mb-2">
                                                    <strong>Last updated:</strong> {{ $swap->updated_at->format('F d, Y \a\t g:i A') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Actions Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    @if($swap->status === 'pending')
                        @if($swap->bookRequested->user_id === Auth::id())
                            <!-- Book owner can accept/decline -->
                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('dashboard.swaps.update-status', $swap) }}">
                                    @csrf
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-check me-2"></i>Accept Swap
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('dashboard.swaps.update-status', $swap) }}">
                                    @csrf
                                    <input type="hidden" name="status" value="declined">
                                    <button type="submit" class="btn btn-outline text-danger w-100">
                                        <i class="fas fa-times me-2"></i>Decline Swap
                                    </button>
                                </form>
                            </div>
                        @elseif($swap->requester_id === Auth::id())
                            <!-- Requester can cancel -->
                            <div class="d-grid gap-2">
                                <form method="POST" action="{{ route('dashboard.swaps.destroy', $swap) }}" 
                                      onsubmit="return confirm('Are you sure you want to cancel this swap request?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline text-danger w-100">
                                        <i class="fas fa-times me-2"></i>Cancel Request
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        <div class="text-center">
                            <p class="text-muted mb-3">
                                @if($swap->status === 'accepted')
                                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i><br>
                                    This swap has been accepted! You can now coordinate the exchange with the other party.
                                @else
                                    <i class="fas fa-times-circle fa-2x text-danger mb-2"></i><br>
                                    This swap request has been declined.
                                @endif
                            </p>
                        </div>
                    @endif
                    
                    <hr>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('dashboard.swaps.index') }}" class="btn btn-outline">
                            <i class="fas fa-arrow-left me-2"></i>Back to Swaps
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- User Information -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">User Information</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="mb-3">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-user fa-2x text-white"></i>
                            </div>
                        </div>
                        <h6 class="mb-1">{{ $swap->requester->name }}</h6>
                        <p class="text-muted small mb-2">{{ $swap->requester->university_name }}</p>
                        @if($swap->requester->department)
                            <p class="text-muted small mb-0">{{ $swap->requester->department }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

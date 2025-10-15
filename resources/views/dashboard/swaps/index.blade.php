@extends('layouts.dashboard')

@section('title', 'Swaps')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">Book Swaps</h2>
                    <p class="text-muted mb-0">Manage your swap requests</p>
                </div>
                <a href="{{ route('dashboard.swaps.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Request Swap
                </a>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="swapTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="received-tab" data-bs-toggle="tab" data-bs-target="#received" type="button" role="tab">
                <i class="fas fa-inbox me-2"></i>Received Requests
                @if($receivedSwaps->count() > 0)
                    <span class="badge badge-warning ms-2">{{ $receivedSwaps->count() }}</span>
                @endif
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="sent-tab" data-bs-toggle="tab" data-bs-target="#sent" type="button" role="tab">
                <i class="fas fa-paper-plane me-2"></i>Sent Requests
                @if($sentSwaps->count() > 0)
                    <span class="badge badge-primary ms-2">{{ $sentSwaps->count() }}</span>
                @endif
            </button>
        </li>
    </ul>

    <div class="tab-content" id="swapTabsContent">
        <!-- Received Swaps Tab -->
        <div class="tab-pane fade show active" id="received" role="tabpanel">
            @if($receivedSwaps->count() > 0)
                <div class="row">
                    @foreach($receivedSwaps as $swap)
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="card-title mb-1">{{ $swap->requester->name }}</h6>
                                            <small class="text-muted">{{ $swap->created_at->diffForHumans() }}</small>
                                        </div>
                                        <span class="badge badge-warning">{{ ucfirst($swap->status) }}</span>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-center">
                                                <h6 class="text-muted mb-2">They Want</h6>
                                                @if($swap->bookRequested->photo_path)
                                                    <img src="{{ $swap->bookRequested->photo_path }}" 
                                                         class="img-thumbnail mb-2 swap-card-image">
                                                @else
                                                    <div class="bg-light rounded mb-2 d-flex align-items-center justify-content-center swap-card-image">
                                                        <i class="fas fa-book text-muted"></i>
                                                    </div>
                                                @endif
                                                <p class="mb-0 small">{{ $swap->bookRequested->title }}</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center">
                                                <h6 class="text-muted mb-2">They Offer</h6>
                                                @if($swap->bookOffered->photo_path)
                                                    <img src="{{ $swap->bookOffered->photo_path }}" 
                                                         class="img-thumbnail mb-2 swap-card-image">
                                                @else
                                                    <div class="bg-light rounded mb-2 d-flex align-items-center justify-content-center swap-card-image">
                                                        <i class="fas fa-book text-muted"></i>
                                                    </div>
                                                @endif
                                                <p class="mb-0 small">{{ $swap->bookOffered->title }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($swap->status === 'pending')
                                        <div class="d-flex gap-2 mt-3">
                                            <form method="POST" action="{{ route('dashboard.swaps.update-status', $swap) }}" class="flex-fill">
                                                @csrf
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit" class="btn btn-success w-100">
                                                    <i class="fas fa-check me-1"></i>Accept
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('dashboard.swaps.update-status', $swap) }}" class="flex-fill">
                                                @csrf
                                                <input type="hidden" name="status" value="declined">
                                                <button type="submit" class="btn btn-outline text-danger w-100">
                                                    <i class="fas fa-times me-1"></i>Decline
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                    
                                    <div class="text-center mt-2">
                                        <a href="{{ route('dashboard.swaps.show', $swap) }}" class="btn btn-outline btn-sm">
                                            <i class="fas fa-eye me-1"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $receivedSwaps->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted mb-3">No swap requests received</h4>
                    <p class="text-muted">You don't have any pending swap requests at the moment.</p>
                </div>
            @endif
        </div>

        <!-- Sent Swaps Tab -->
        <div class="tab-pane fade" id="sent" role="tabpanel">
            @if($sentSwaps->count() > 0)
                <div class="row">
                    @foreach($sentSwaps as $swap)
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="card-title mb-1">To: {{ $swap->bookRequested->user->name }}</h6>
                                            <small class="text-muted">{{ $swap->created_at->diffForHumans() }}</small>
                                        </div>
                                        @if($swap->status === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($swap->status === 'accepted')
                                            <span class="badge badge-success">Accepted</span>
                                        @else
                                            <span class="badge badge-danger">Declined</span>
                                        @endif
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-center">
                                                <h6 class="text-muted mb-2">You Want</h6>
                                                @if($swap->bookRequested->photo_path)
                                                    <img src="{{ $swap->bookRequested->photo_path }}" 
                                                         class="img-thumbnail mb-2 swap-card-image">
                                                @else
                                                    <div class="bg-light rounded mb-2 d-flex align-items-center justify-content-center swap-card-image">
                                                        <i class="fas fa-book text-muted"></i>
                                                    </div>
                                                @endif
                                                <p class="mb-0 small">{{ $swap->bookRequested->title }}</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center">
                                                <h6 class="text-muted mb-2">You Offer</h6>
                                                @if($swap->bookOffered->photo_path)
                                                    <img src="{{ $swap->bookOffered->photo_path }}" 
                                                         class="img-thumbnail mb-2 swap-card-image">
                                                @else
                                                    <div class="bg-light rounded mb-2 d-flex align-items-center justify-content-center swap-card-image">
                                                        <i class="fas fa-book text-muted"></i>
                                                    </div>
                                                @endif
                                                <p class="mb-0 small">{{ $swap->bookOffered->title }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($swap->status === 'pending')
                                        <div class="text-center mt-3">
                                            <form method="POST" action="{{ route('dashboard.swaps.destroy', $swap) }}" 
                                                  class="d-inline" 
                                                  onsubmit="return confirm('Are you sure you want to cancel this swap request?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline text-danger">
                                                    <i class="fas fa-times me-1"></i>Cancel Request
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                    
                                    <div class="text-center mt-2">
                                        <a href="{{ route('dashboard.swaps.show', $swap) }}" class="btn btn-outline btn-sm">
                                            <i class="fas fa-eye me-1"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $sentSwaps->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-paper-plane fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted mb-3">No swap requests sent</h4>
                    <p class="text-muted">You haven't sent any swap requests yet.</p>
                    <a href="{{ route('dashboard.swaps.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Request Your First Swap
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

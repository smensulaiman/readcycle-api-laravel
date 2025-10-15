@extends('layouts.master')

@section('content')
<div class="container-xxl py-5">
    <div class="container py-5 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded p-5">
                        <h2 class="text-primary-gradient fw-medium mb-4">Join ReadCycle</h2>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" placeholder="Your Name" 
                                               value="{{ old('name') }}" required>
                                        <label for="name">Full Name</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" placeholder="Your Email" 
                                               value="{{ old('email') }}" required>
                                        <label for="email">Email Address</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('university_name') is-invalid @enderror" 
                                               id="university_name" name="university_name" placeholder="University Name" 
                                               value="{{ old('university_name') }}" required>
                                        <label for="university_name">University Name</label>
                                        @error('university_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('department') is-invalid @enderror" 
                                               id="department" name="department" placeholder="Department" 
                                               value="{{ old('department') }}">
                                        <label for="department">Department (Optional)</label>
                                        @error('department')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-control @error('year') is-invalid @enderror" 
                                                id="year" name="year">
                                            <option value="">Select Year</option>
                                            <option value="1st" {{ old('year') == '1st' ? 'selected' : '' }}>1st Year</option>
                                            <option value="2nd" {{ old('year') == '2nd' ? 'selected' : '' }}>2nd Year</option>
                                            <option value="3rd" {{ old('year') == '3rd' ? 'selected' : '' }}>3rd Year</option>
                                            <option value="4th" {{ old('year') == '4th' ? 'selected' : '' }}>4th Year</option>
                                            <option value="Graduate" {{ old('year') == 'Graduate' ? 'selected' : '' }}>Graduate</option>
                                        </select>
                                        <label for="year">Academic Year (Optional)</label>
                                        @error('year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               id="password" name="password" placeholder="Password" required>
                                        <label for="password">Password</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                               id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                        <label for="password_confirmation">Confirm Password</label>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary-gradient rounded-pill py-3 px-5" type="submit">
                                        Create Account
                                    </button>
                                </div>
                                
                                <div class="col-12 text-center">
                                    <p class="mb-0">
                                        Already have an account? 
                                        <a href="{{ route('login') }}" class="text-primary-gradient fw-medium">Login here</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @include('layouts.scripts')
@endpush

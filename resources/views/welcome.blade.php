@extends('layouts.master')

@section('content')
    @if(session('success'))
        <div class="container-xxl py-2">
            <div class="container px-lg-5">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Hero Start -->
    <div class="container-xxl bg-primary hero-header">
        <div class="container px-lg-5">
            <div class="row g-5">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="text-white mb-4 animated slideInDown">ReadCycle – Swap, read and repeat.</h1>
                    <p class="text-white pb-3 animated slideInDown">ReadCycle is an app designed to promote sustainable consumption by connecting book lovers with each other in their local community. With ReadCycle, users can trade or donate their gently used books with others, reducing their environmental impact and promoting sustainable practices.</p>
                    @auth
                        <a href="{{ route('dashboard.index') }}" class="btn btn-secondary-gradient py-sm-3 px-4 px-sm-5 rounded-pill animated slideInRight">Go to Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-secondary-gradient py-sm-3 px-4 px-sm-5 rounded-pill animated slideInRight me-3">Get Started</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light py-sm-3 px-4 px-sm-5 rounded-pill animated slideInRight me-3">Login</a>
                        <a href="{{ route('documentation') }}" class="btn btn-outline-light py-sm-3 px-4 px-sm-5 rounded-pill animated slideInRight me-3">Documentation</a>
                        <a href="{{ route('swagger') }}" class="btn btn-outline-light py-sm-3 px-4 px-sm-5 rounded-pill animated slideInRight">API Docs</a>
                    @endauth
                </div>
                <div class="col-lg-4 d-flex justify-content-center justify-content-lg-end wow fadeInUp" data-wow-delay="0.3s">
                    <div class="owl-carousel screenshot-carousel">
                        <img class="img-fluid" src="../assets/img/6.png" alt="">
                        <img class="img-fluid" src="../assets/img/5.png" alt="">
                        <img class="img-fluid" src="../assets/img/4.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="container-xxl py-5" id="about">
        <div class="container py-5 px-lg-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="text-primary-gradient fw-medium">TECHNOLOGY STACK</h5>
                    <ul>
                        <li>- Android (Java) for mobile client</li>
                        <li>- Laravel (PHP) for backend API</li>
                        <li>- Firebase Realtime Database for data storage</li>
                        <li>- Retrofit and OkHttp for API communication</li>
                        <li>- Gson for JSON serialization</li>
                        <li>- MySQL for structured data</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid wow fadeInUp" data-wow-delay="0.5s" src="../assets/img/6.png">
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Features Start -->
    <div class="container-xxl" id="feature">
        <div class="container py-5 px-lg-5">
            <div class="text-center wow fadeInUp mt-4" data-wow-delay="0.1s">
                <h1 class="text-primary-gradient fw-medium">App Features</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="feature-item bg-light rounded p-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-eye text-white fs-4"></i>
                        </div>
                        <h5 class="mb-3">Sign up/Log in</h5>
                        <p class="m-0">Users can create an account or log in to their existing account using their email address or social media accounts.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="feature-item bg-light rounded p-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-edit text-white fs-4"></i>
                        </div>
                        <h5 class="mb-3">Post books</h5>
                        <p class="m-0">Users can post their own books for trade or donation, which other users can browse and contact them about.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="feature-item bg-light rounded p-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-layer-group text-white fs-4"></i>
                        </div>
                        <h5 class="mb-3">Book exchange</h5>
                        <p class="m-0">Users can browse available books in their local community, which are posted by other users of the app.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Start -->
    <div class="container-xxl py-5" id="contact">
        <div class="container py-5 px-lg-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="text-primary-gradient fw-medium">Contact Us</h5>
                <h1 class="mb-5">Get In Touch!</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="wow fadeInUp" data-wow-delay="0.3s">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 150px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary-gradient rounded-pill py-3 px-5" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

@push('scripts')
    @include('layouts.scripts')
@endpush

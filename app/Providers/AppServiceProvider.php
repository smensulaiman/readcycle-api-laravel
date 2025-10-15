<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Swap;
use App\Models\User;
use App\Policies\BookPolicy;
use App\Policies\SwapPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register policies
        Gate::policy(Book::class, BookPolicy::class);
        Gate::policy(Swap::class, SwapPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
    }
}

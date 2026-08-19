<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Gate for buying - only buyers can buy
        Gate::define('buy', function ($user) {
            return $user->isBuyer();
        });

        // Gate for selling - only sellers can sell
        Gate::define('sell', function ($user) {
            return $user->isSeller();
        });

        // Gate for admin - only admins
        Gate::define('admin', function ($user) {
            return $user->isAdmin();
        });

        // Gate for messaging - authenticated users only
        Gate::define('message', function ($user) {
            return true; // All authenticated users can message
        });
    }
}

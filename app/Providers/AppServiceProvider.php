<?php

namespace App\Providers;

use App\User;
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
        Gate::define('admin-panel', fn (User $user) => $user->isAdmin());

        Gate::define('manage-users', fn (User $user) => $user->isAdmin());

        Gate::define('log-owner', function (User $user, $userId) {
            return $user->isAdmin() || $userId == $user->id;
        });
    }
}

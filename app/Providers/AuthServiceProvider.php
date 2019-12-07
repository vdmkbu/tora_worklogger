<?php

namespace App\Providers;

use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-panel', function (User $user) {
           return $user->isAdmin();
        });

        Gate::define('manage-users', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('log-owner', function (User $user, $userId) {
            if ($user->isAdmin()) {
                return true;
            }
            else {
                return $userId == $user->id;
            }

        });
    }
}

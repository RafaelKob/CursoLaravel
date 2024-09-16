<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Gate as AccessGate;
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
        Gate::define('is-admin', function(User $user): bool {
            return $user->isAdm();
        });

        Gate::define('owner', function(User $user, object $register) {
            return $user->id === $register->user_id;
        });


        /*
        Gate::define('is-admin', function (User $user): bool {
            return $user->isAdm();
        });

        Gate::define('owner', function (User $user, object $register): bool {
            return $user->id === $register->user_id;
        });
        */
    }
}

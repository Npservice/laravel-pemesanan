<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Policies\PolicyUser;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy appings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => PolicyUser::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('admin', function (User $user) {
            return $user->role == 'admin';
        });
        Gate::define('atasan', function (User $user) {
            return $user->role == 'atasan';
        });
    }
}

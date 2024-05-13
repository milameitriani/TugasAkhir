<?php

namespace App\Providers;

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
        'App\Models\Order' => 'App\Policies\OrderPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user)
        {
            return $user->role === 'admin';
        });

        Gate::define('kasir', function ($user)
        {
            return $user->role === 'kasir';
        });

        Gate::define('pelayanan', function ($user)
        {
            return $user->role === 'pelayanan';
        });

        Gate::define('koki', function ($user)
        {
            return $user->role === 'koki';
        });

        Gate::define('bar', function ($user)
        {
            return $user->role === 'bar';
        });
    }
}

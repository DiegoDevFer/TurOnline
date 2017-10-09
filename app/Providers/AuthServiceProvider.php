<?php

namespace TurOnline\Providers;

use function foo\func;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use TurOnline\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'TurOnline\Model' => 'TurOnline\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('access-admin', function($user){
            return $user->role <= User::ROLE_ADMIN;
        });

        Gate::define('access-super-admin', function($user){
            return $user->role <= User::ROLE_S_ADMIN;
        });
    }
}

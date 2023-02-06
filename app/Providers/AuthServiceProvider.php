<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Carbon\Carbon;

/**
 * Class AuthServiceProvider.
 */
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

        // Implicitly grant "Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user) {
            return $user->hasAllAccess() ? true : null;
        });

        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addMonths(1));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(45));
        // Passport::personalAccessTokensExpireIn(Carbon::now()->addDays(30));

        // Learn when to use this instead: https://docs.spatie.be/laravel-permission/v3/basic-usage/super-admin/#gate-after
        //        Gate::after(function ($user) {
        //            return $user->hasAllAccess();
        //        });
    }
}

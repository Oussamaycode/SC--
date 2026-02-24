<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        Gate::define('show-administration',function($user){
            return $user->role==="admin";
        });
        Gate::define('create-colocation',function($user){
            return $user->colocation_id==null;
        });
    }
}

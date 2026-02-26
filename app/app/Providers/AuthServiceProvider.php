<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Membership;

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
        Gate::define('show-administration',function($user,){
            return $user->role==="admin";
        });
        Gate::define('create-join-colocation',function($user){

            return !$user->memberships()
                   ->whereHas('colocation', function ($query) {
                        $query->where('is_active', true);
                    })
                    ->exists();
        });
        
        Gate::define('cancel-colocation',function($user){
            return $user->is_owner===true;
        });
        Gate::define('add-expense',function($user){

        return $user->memberships() ->whereHas('colocation', function ($query) {
                    $query->where('is_active', true);
                    })->exists();
            });
    }
}

<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
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
        try {
            Gate::before(function (User $user,) {
                if ($user->isSuperAdmin() || $user->hasRole(['programmer'])) {
                    return true;
                }
            });


            foreach (Permission::where('status', 1)->get() as $permission) {
                Gate::define($permission->title, function (User $user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            }

            Blade::if('role', function ($role) {
                return auth()->check() && auth()->user()->hasRole($role);
            });


        } catch (\Exception $e) {
            report($e);
        }
    }
}

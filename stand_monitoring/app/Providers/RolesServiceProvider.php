<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RolesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */

    /*
    позволяет просто использовать авторизацию в шаблонах blade
    например, @role('Admin')
                Admin panel
              @endrole
    */
    public function boot()
    {
        Blade::directive('role', function ($role){
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });

        Blade::directive('endrole', function ($role){
            return "<?php endif; ?>";
        });
    }
}

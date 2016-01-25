<?php

namespace Serenity\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        // Bind custom resource registrar
        $this->app->bind('Illuminate\Routing\ResourceRegistrar', 'Serenity\Routing\ResourceRegistrar');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        require app_path('Http/admin.routes.php');
        require app_path('Http/architect.routes.php');
        require app_path('Http/front.routes.php');
    }
}

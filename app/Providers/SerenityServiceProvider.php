<?php

namespace Serenity\Providers;

use GUI;
use Illuminate\Support\ServiceProvider;

class SerenityServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require app_path('start.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Create admin window
        $this->app->instance('adminWindow', GUI::window());

        // Create architect window
        $this->app->instance('architectWindow', GUI::window());
    }
}

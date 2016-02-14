<?php

namespace Serenity\Providers;

use Illuminate\Support\ServiceProvider;
use Serenity\Fields\Contracts\FieldsManagerContract;
use Serenity\Fields\FieldsManager;

class FieldsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(FieldsManagerContract $fieldsManager)
    {
		// Register fields
		$fieldsManager->register(\Serenity\Fields\Implementations\InputField::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind fields manager implementations
        $this->app->bind(FieldsManagerContract::class, FieldsManager::class, true);
    }
}

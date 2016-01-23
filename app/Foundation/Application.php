<?php

namespace Serenity\Foundation;

use Route;
use Illuminate\Foundation\Application as LaravelApplication;

class Application extends LaravelApplication
{
    /**
     * Admin URL prefix.
     *
     * @var string
     */
    protected $adminPrefix = 'admin';

    /**
     * Architect (backend) URL prefix.
     *
     * @var string
     */
    protected $architectPrefix = 'admin/architect';

    /**
     * Website (frontend) URL prefix.
     *
     * @var string
     */
    protected $frontPrefix = '';

    public function getAdminPrefix()
    {
        return $this->adminPrefix;
    }

    public function getArchitectPrefix()
    {
        return $this->architectPrefix;
    }

    public function getFrontPrefix()
    {
        return $this->frontPrefix;
    }

    /**
     * Return admin window instance if parameter is null.
     * Return result of callable function. Admin window
     * instance will be passed to callable as argument.
     *
     * @param  callable|null $callable
     * @return mixed
     */
    public function adminWindow(callable $callable = null)
    {
        // Get admin window instance
        $adminWindow = $this->make('adminWindow');

        if ($callable == null)
        {
            return $adminWindow;
        }
        else
        {
            return $callable($adminWindow);
        }
    }

    /**
     * Register administration login (backend) routes.
     *
     * @param  string   $namespace Namespace of registered controllers.
     * @param  callable $callable
     * @return mixed
     */
    public function adminAuthRoutes($namespace, callable $callable)
    {
        Route::group(['middleware' => ['web'], 'prefix' => $this->adminPrefix, 'namespace' => $namespace], function($router) use ($callable)
        {
            return $callable($router);
        });
    }

    /**
     * Register administration (backend) routes.
     *
     * @param  string   $namespace Namespace of registered controllers.
     * @param  callable $callable
     * @return mixed
     */
    public function adminRoutes($namespace, callable $callable)
    {
        Route::group(['middleware' => ['web', \Serenity\Core\Http\Middleware\Authenticate::class], 'prefix' => $this->adminPrefix, 'namespace' => $namespace], function($router) use ($callable)
        {
            return $callable($router);
        });
    }

    /**
     * Return architect window instance if parameter is null.
     * Return result of callable function. Architect window
     * instance will be passed to callable as argument.
     *
     * @param  callable|null $callable
     * @return mixed
     */
    public function architectWindow(callable $callable = null)
    {
        // Get architect window instance
        $architectWindow = $this->make('architectWindow');

        if ($callable == null)
        {
            return $architectWindow;
        }
        else
        {
            return $callable($architectWindow);
        }
    }

    /**
     * Register architect (backend) routes.
     *
     * @param  string   $namespace Namespace of registered controllers.
     * @param  callable $callable
     * @return mixed
     */
    public function architectRoutes($namespace, callable $callable)
    {
        Route::group(['middleware' => ['web', \Serenity\Core\Http\Middleware\Authenticate::class], 'prefix' => $this->architectPrefix, 'namespace' => $namespace], function($router) use ($callable)
        {
            return $callable($router);
        });
    }

    /**
     * Register website (frontend) routes.
     *
     * @param  string   $namespace Namespace of registered controllers.
     * @param  callable $callable
     * @return mixed
     */
    public function frontRoutes($namespace, callable $callable)
    {
        Route::group(['middleware' => 'web', 'prefix' => $this->frontPrefix, 'namespace' => $namespace], function($router) use ($callable)
        {
            return $callable($router);
        });
    }
}

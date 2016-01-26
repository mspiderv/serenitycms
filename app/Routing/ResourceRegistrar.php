<?php 

namespace Serenity\Routing;

use Illuminate\Routing\ResourceRegistrar as LaravelResourceRegistrar;

class ResourceRegistrar extends LaravelResourceRegistrar
{
    /**
     * Route a resource to a controller.
     *
     * @param  string  $name
     * @param  string  $controller
     * @param  array   $options
     * @return void
     */
    public function register($name, $controller, array $options = [])
    {
        if ($options == [])
        {
            $options = [ 'except' => 'show' ];
        }

        return parent::register($name, $controller, $options);
    }

    /**
     * Add the update method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array   $options
     * @return void
     */
    protected function addResourceUpdate($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name).'/{'.$base.'}/update';

        $action = $this->getResourceAction($name, $controller, 'update', $options);

        return $this->router->post($uri, $action);
    }

    /**
     * Add the destroy method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array   $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceDestroy($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name).'/{'.$base.'}/destroy';

        $action = $this->getResourceAction($name, $controller, 'destroy', $options);

        return $this->router->get($uri, $action);
    }
}
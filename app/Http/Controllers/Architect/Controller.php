<?php

namespace Serenity\Http\Controllers\Architect;

use App;
use Serenity\Http\Controllers\GUIController;

abstract class Controller extends GUIController
{
    protected function initializeWindow()
    {
        // Set architectu window skin
        config(['gui-adminlte.skin' => 'red-light']);

        return App::architectWindow();
    }
}

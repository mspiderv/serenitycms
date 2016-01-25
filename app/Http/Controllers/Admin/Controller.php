<?php

namespace Serenity\Http\Controllers\Admin;

use App;
use Serenity\Http\Controllers\GUIController;

abstract class Controller extends GUIController
{
    protected function initializeWindow()
    {
        return App::adminWindow();
    }
}

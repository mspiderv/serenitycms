<?php

namespace Serenity\Http\Controllers;

use App;

abstract class ArchitectController extends AdminController
{
    protected function initializeWindow()
    {
        $this->window = App::architectWindow();

        // Set architecture window skin
        config(['gui-adminlte.skin' => 'red-light']);
    }
}

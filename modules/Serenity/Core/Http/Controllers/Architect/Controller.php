<?php

namespace Serenity\Core\Http\Controllers\Architect;

use GUI;
use Serenity\Http\Controllers\ArchitectController;

class Controller extends ArchitectController
{
    public function dashboard()
    {
        // Title
        $this->title('Architektúra');

        // Content
        GUI::tag('p', 'Toto je architektúra systému.')->to($this->window);

        // Render
        return $this->render();
    }

}

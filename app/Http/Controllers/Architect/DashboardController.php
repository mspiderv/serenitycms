<?php

namespace Serenity\Http\Controllers\Architect;

use GUI;

class DashboardController extends Controller
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

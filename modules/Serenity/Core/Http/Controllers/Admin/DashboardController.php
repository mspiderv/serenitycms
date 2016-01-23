<?php

namespace Serenity\Core\Http\Controllers\Admin;

use GUI;
use Serenity\Http\Controllers\AdminController;

class DashboardController extends AdminController
{
    public function dashboard()
    {
        // Title
        $this->title('Hlavný panel');

        // Row
        $row = GUI::row('col-md-3', 'col-md-3', 'col-md-3', 'col-md-3')->to($this->window);

        // Info widgets
        GUI::infoWidget('Stránky', 35, 'fa fa-file-text', 'green')->to($row);
        GUI::infoWidget('Panely', 15, 'fa fa-cubes', 'red')->to($row);
        GUI::infoWidget('Zoznamy', 7, 'fa fa-list', 'blue')->to($row);
        GUI::infoWidget('Moduly', 74, 'fa fa-puzzle-piece', 'yellow')->to($row);

        // Render
        return $this->render();
    }

}

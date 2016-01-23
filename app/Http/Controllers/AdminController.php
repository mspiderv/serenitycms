<?php

namespace Serenity\Http\Controllers;

use App;
use GUI;
use URL;

abstract class AdminController extends Controller
{
    protected $window = null;
    protected $titleDelimiter;
    protected $titleSuffix;

    public function __construct()
    {
        // Get admin window instance
        $this->initializeWindow();

        // Set title configuration
        $this->titleDelimiter = config('serenity.admin.title.delimiter', ' | ');
        $this->titleSuffix = config('serenity.admin.title.suffix');

        if ($this->titleSuffix == '')
        {
            $this->titleSuffix = config('serenity.name');
        }

        // Set logo variables
        $this->window->set('logo_text', config('serenity.admin.logo.text'));
        $this->window->set('mini_logo_text', config('serenity.admin.logo.smallText'));

        // Set default title
        $this->title($this->defaultTitle());
    }

    protected function initializeWindow()
    {
        $this->window = App::adminWindow();
    }

    protected function render()
    {
        return $this->window->render();
    }

    protected function title($title)
    {
        // Set title
        $this->window->set('title', ($title == '') ? $this->titleSuffix : ($title . $this->titleDelimiter . $this->titleSuffix));

        // Set heading
        $this->window->set('heading', ($title == '') ? $this->titleSuffix : $title);
    }

    protected function defaultTitle()
    {
        return '';
    }

}

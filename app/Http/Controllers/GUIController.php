<?php

namespace Serenity\Http\Controllers;

abstract class GUIController extends AbstractController
{
    protected $window = null;
    protected $titleDelimiter;
    protected $titleSuffix;

    public function __construct()
    {
        // Get admin window instance
        $this->window = $this->initializeWindow();

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

    abstract protected function initializeWindow();

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

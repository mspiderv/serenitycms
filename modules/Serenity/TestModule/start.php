<?php

// Customize admin window
App::adminWindow(function($window) {

    // Menu
    $menu = $window->getSidebarMenu();
    $menu->link('Test module link', '#', 'fa fa-file');

});
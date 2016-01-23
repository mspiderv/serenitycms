<?php

// Admin routes
App::adminRoutes('Serenity\Core\Http\Controllers\Admin', function() {

    // Dashboard
    //Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'Controller@dashboard']);

});

// Customize admin window
App::adminWindow(function($window) {

    // Menu
    $menu = $window->getSidebarMenu();

    $menu->link('Typy stránok', URL::to('admin/page-types'), 'fa fa-file', function($sub) {
        $sub->link('Výpis typov stránok', URL::to('admin/page-types'), 'fa fa-list');
        $sub->link('Vytvoriť typ stránky', URL::to('admin/page-types/add'), 'fa fa-plus-square');
    });

});
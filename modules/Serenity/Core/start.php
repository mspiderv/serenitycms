<?php

// Admin auth routes
App::adminAuthRoutes('Serenity\Core\Http\Controllers\Admin', function() {

    // Auth
    Route::get('login', ['as' => 'admin.login', 'uses' => 'AuthController@getLogin']);
    Route::post('login', ['as' => 'admin.login.post', 'uses' => 'AuthController@postLogin']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'AuthController@getLogout']);

});

// Admin routes
App::adminRoutes('Serenity\Core\Http\Controllers\Admin', function() {

    // Dashboard
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@dashboard']);

});

// Architect routes
App::architectRoutes('Serenity\Core\Http\Controllers\Architect', function() {

    // Dashboard
    Route::get('/', ['as' => 'architect.dashboard', 'uses' => 'Controller@dashboard']);

});

// Front routes
App::frontRoutes('Serenity\Core\Http\Controllers\Front', function() {

    Route::get('/', ['as' => 'front', 'uses' => 'Controller@front']);

});

// Customize admin window
App::adminWindow(function($window) {

    // Set admin window variables
    $window->set('logo_href', route('admin.dashboard'));
    $window->set('webURL', route('front'));
    $window->set('logoutURL', route('admin.logout'));

    // Menu
    $menu = $window->getSidebarMenu();

    $menu->link('Architektúra', route('architect.dashboard'), 'fa fa-exchange');

    $menu->heading('HLAVNÁ NAVIGÁCIA');

    $menu->link('Hlavný panel', route('admin.dashboard'), 'fa fa-dashboard');

});

// Customize architect window
App::architectWindow(function($window) {

    // Set admin window variables
    $window->set('logo_href', route('admin.dashboard'));
    $window->set('webURL', route('front'));
    $window->set('logoutURL', route('admin.logout'));

    // Menu
    $menu = $window->getSidebarMenu();

    $menu->link('Administrácia', route('admin.dashboard'), 'fa fa-exchange');

    $menu->heading('HLAVNÁ NAVIGÁCIA');

    $menu->link('Hlavný panel', route('architect.dashboard'), 'fa fa-dashboard');

});

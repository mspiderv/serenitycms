<?php

// Architect routes
App::architectRoutes('Serenity\Modules\Http\Controllers\Architect', function() {

    // Modules
    Route::group(['prefix' => 'modules'], function() {
        Route::get('/', ['as' => 'architect.modules.index', 'uses' => 'ModulesController@index']);
        Route::get('show/{module}', ['as' => 'architect.modules.show', 'uses' => 'ModulesController@show']);
        Route::get('install/{module}', ['as' => 'architect.modules.install', 'uses' => 'ModulesController@install']);
        Route::get('uninstall/{module}', ['as' => 'architect.modules.uninstall', 'uses' => 'ModulesController@uninstall']);
        Route::get('remove/{module}', ['as' => 'architect.modules.remove', 'uses' => 'ModulesController@remove']);
    });

});

// Customize architect window
App::architectWindow(function($window) {

    // Menu
    $menu = $window->getSidebarMenu();

    $menu->link('Moduly', route('architect.modules.index'), 'fa fa-puzzle-piece');

});
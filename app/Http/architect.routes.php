<?php 

// Architect routes
App::architectRoutes('Serenity\Http\Controllers\Architect', function() {

    // Dashboard
    Route::get('/', ['as' => 'admin.architect.dashboard', 'uses' => 'DashboardController@dashboard']);

    // Modules
    Route::group(['prefix' => 'modules'], function() {
        Route::get('/', ['as' => 'admin.architect.modules.index', 'uses' => 'ModulesController@index']);
        Route::get('show/{module}', ['as' => 'admin.architect.modules.show', 'uses' => 'ModulesController@show']);
        Route::get('install/{module}', ['as' => 'admin.architect.modules.install', 'uses' => 'ModulesController@install']);
        Route::get('uninstall/{module}', ['as' => 'admin.architect.modules.uninstall', 'uses' => 'ModulesController@uninstall']);
        Route::get('remove/{module}', ['as' => 'admin.architect.modules.remove', 'uses' => 'ModulesController@remove']);
    });

    // Content Types
    Route::resource('content-types', 'ContentTypesController');
    Route::resource('content-type-variables', 'ContentTypeVariablesController');

});
<?php 

// Admin auth routes
App::adminAuthRoutes('Serenity\Http\Controllers\Admin', function() {

    // Auth
    Route::get('login', ['as' => 'admin.login', 'uses' => 'AuthController@getLogin']);
    Route::post('login', ['as' => 'admin.login.post', 'uses' => 'AuthController@postLogin']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'AuthController@getLogout']);

});

// Admin routes
App::adminRoutes('Serenity\Http\Controllers\Admin', function() {

    // Dashboard
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@dashboard']);

    // Regions
    Route::resource('regions', 'RegionsController', ['all']);
    
    // Districts
    Route::resource('districts', 'DistrictsController', ['except' => ['index']]);

});
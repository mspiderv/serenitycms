<?php 

// Front routes
App::frontRoutes('Serenity\Http\Controllers\Front', function() {

    Route::get('/', ['as' => 'front', 'uses' => 'Controller@front']);

});
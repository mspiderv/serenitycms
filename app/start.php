<?php 

// Customize admin window
App::adminWindow(function($window) {

    // Set admin window variables
    $window->set('logo_href', route('admin.dashboard'));
    $window->set('webURL', route('front'));
    $window->set('logoutURL', route('admin.logout'));

    // Menu
    $menu = $window->getSidebarMenu();

    $menu->link('Architektúra', route('admin.architect.dashboard'), 'fa fa-exchange');

    $menu->heading('HLAVNÁ NAVIGÁCIA');

    $menu->link('Hlavný panel', route('admin.dashboard'), 'fa fa-dashboard');
    $menu->link('Typy stránok', URL::to('admin/page-types'), 'fa fa-file', function($sub) {
        $sub->link('Výpis typov stránok', URL::to('admin/page-types'), 'fa fa-list');
        $sub->link('Vytvoriť typ stránky', URL::to('admin/page-types/add'), 'fa fa-plus-square');
    });
    $menu->link('Regióny', route('admin.regions.index'), 'fa fa-globe');

});

// Customize architect window
App::architectWindow(function($window) {

    // Set architect window variables
    $window->set('logo_href', route('admin.dashboard'));
    $window->set('webURL', route('front'));
    $window->set('logoutURL', route('admin.logout'));

    // Menu
    $menu = $window->getSidebarMenu();

    $menu->link('Administrácia', route('admin.dashboard'), 'fa fa-exchange');

    $menu->heading('HLAVNÁ NAVIGÁCIA');

    $menu->link('Hlavný panel', route('admin.architect.dashboard'), 'fa fa-dashboard');
    $menu->link('Moduly', route('admin.architect.modules.index'), 'fa fa-puzzle-piece');
    $menu->link('Typy obsahu', route('admin.architect.content-types.index'), 'fa fa-file', function($sub) {
        $sub->link('Výpis typov obsahu', route('admin.architect.content-types.index'), 'fa fa-list');
        $sub->link('Vytvoriť typ obsahu', route('admin.architect.content-types.create'), 'fa fa-plus-square');
    });

});
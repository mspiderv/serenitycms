<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('', function() {

    // Window
    $window = GUI::window([
        'title' => 'Serenity CMS',
        'logo_text' => 'Serenity CMS',
        'mini_logo_text' => 'SCMS',
        'logo_href' => URL::to(''),
        'heading' => 'Serenity CMS',
        'heading_small' => 'All Elements',
        'webURL' => URL::to(''),
        'logoutURL' => URL::to('login'),
    ]);

    // Menu
    $menu = $window->getSidebarMenu();

    $menu->heading('HLAVNÁ NAVIGÁCIA');

    $menu->link('Hlavný panel', URL::to('admin'), 'fa fa-dashboard')->cur();

    $menu->heading('OBSAH');

    $menu->link('Stránky', URL::to('admin/pages'), 'fa fa-file-text', function($sub) {
        $sub->link('Výpis stránok', URL::to('admin/pages'), 'fa fa-list');
        $sub->link('Vytvoriť stránku', URL::to('admin/pages/add'), 'fa fa-plus-square');
    });

    $menu->link('Typy stránok', URL::to('admin/page-types'), 'fa fa-file', function($sub) {
        $sub->link('Výpis typov stránok', URL::to('admin/page-types'), 'fa fa-list');
        $sub->link('Vytvoriť typ stránky', URL::to('admin/page-types/add'), 'fa fa-plus-square');
    });

    $menu->link('Kategórie', URL::to('admin/categories'), 'fa fa-folder', function($sub) {
        $sub->link('Výpis kategórií', URL::to('admin/categories'), 'fa fa-list');
        $sub->link('Vytvoriť kategóriu', URL::to('admin/categories/add'), 'fa fa-plus-square');
        $sub->link('Zaradenie stránok', URL::to('admin/categories/bindings'), 'fa fa-list-alt');
    });

    $menu->link('Menu', URL::to('admin/menus'), 'fa fa-list', function($sub) {
        $sub->link('Výpis menu', URL::to('admin/menus'), 'fa fa-list');
        $sub->link('Vytvoriť menu', URL::to('admin/menus/add'), 'fa fa-plus-square');
    });

    $menu->link('Panely', URL::to('admin/panels'), 'fa fa-puzzle-piece', function($sub) {
        $sub->link('Výpis panelov', URL::to('admin/panels'), 'fa fa-list');
        $sub->link('Vytvoriť panel', URL::to('admin/panels/add'), 'fa fa-plus-square');
    });

    $menu->link('Typy panelov', URL::to('admin/panel-types'), 'fa fa-wrench', function($sub) {
        $sub->link('Výpis typov panelov', URL::to('admin/panel-types'), 'fa fa-list');
        $sub->link('Vytvoriť typ panela', URL::to('admin/panel-types/add'), 'fa fa-plus-square');
    });

    $menu->link('Pozície', URL::to('admin/positions'), 'fa fa-flag', function($sub) {
        $sub->link('Výpis pozícií', URL::to('admin/positions'), 'fa fa-list');
        $sub->link('Vytvoriť pozíciu', URL::to('admin/positions/add'), 'fa fa-plus-square');
        $sub->link('Zaradenie panelov', URL::to('admin/positions/bindings'), 'fa fa-list-alt');
    });

    $menu->link('Zoznamy', URL::to('admin/lists'), 'fa fa-list', function($sub) {
        $sub->link('Výpis zoznamov', URL::to('admin/lists'), 'fa fa-list');
        $sub->link('Vytvoriť zoznam', URL::to('admin/lists/add'), 'fa fa-plus-square');
    });

    $menu->link('Typy zoznamov', URL::to('admin/list-types'), 'fa fa-wrench', function($sub) {
        $sub->link('Výpis typov zoznamov', URL::to('admin/list-types'), 'fa fa-list');
        $sub->link('Vytvoriť typ zoznamu', URL::to('admin/list-types/add'), 'fa fa-plus-square');
    });

    $menu->heading('OSTATNÉ');

    $menu->link('Nastavenia', URL::to('admin/settings'), 'fa fa-cogs', function($sub) {
        $sub->link('Jazyky', URL::to('admin/languages'), 'fa fa-language');
        $sub->link('Administrátori', URL::to('admin/admins'), 'fa fa-group');
        $sub->link('Témy', URL::to('admin/themes'), 'fa fa-image');
        $sub->link('Domény', URL::to('admin/domains'), 'fa fa-server');
        $sub->link('Dátové zdroje', URL::to('admin/resources'), 'fa fa-wrench');
        $sub->link('Zálohy databázy', URL::to('admin/db-backups'), 'fa fa-database');
        $sub->link('Atribúty odkazov', URL::to('admin/link-attributes'), 'fa fa-link');
        $sub->link('Služby', URL::to('admin/services'), 'fa fa-cubes');
        $sub->link('Zablokované IP', URL::to('admin/banned-ips'), 'fa fa-ban');
        $sub->link('Presmerovania', URL::to('admin/redirects'), 'fa fa-exchange');
        $sub->link('Súčasti', URL::to('admin/parts'), 'fa fa-puzzle-piece');
        $sub->link('Štítky', URL::to('admin/labels'), 'fa fa-bookmark');
        $sub->link('Správca súborov', URL::to('admin/file-manager'), 'fa fa-folder');
    });

    $menu->link('E-maily', URL::to('admin/emails'), 'fa fa-envelope', function($sub) {
        $sub->link('E-maily', URL::to('admin/emails'), 'fa fa-paper-plane');
        $sub->link('Kópie e-mailov', URL::to('admin/emails/copies'), 'fa fa-copy');
        $sub->link('Šablóny e-mailov', URL::to('admin/emails/wraps'), 'fa fa-code');
    });

    // Navbar menu
    $menu = $window->getNavbarMenu();

    $menu->link('Slovenčina')->sub(function($sub) {
        $sub->link('English', URL::to('admin/lang/set/en'));
        $sub->link('<strong>Slovenčina</strong>', URL::to('admin/lang/set/sk'));
        $sub->link('Česky', URL::to('admin/lang/set/cs'));
        $sub->link('Deutch', URL::to('admin/lang/set/de'));
    });

    // Breadcrumbs
    $window->addBreadcrumb('Dashboard', url(''));
    $window->addBreadcrumb('All Elements', url(''));

    // Row
    $row = GUI::row('col-md-3', 'col-md-3', 'col-md-3', 'col-md-3')->to($window);

    // Widgets
    GUI::infoWidget('MESSAGES', '1,410', 'fa fa-envelope-o', 'aqua')->to($row);
    GUI::infoWidget('BOOKMARKS', '410', 'fa fa-flag-o', 'green')->to($row);
    GUI::infoWidget('UPLOADS', '13,648', 'fa fa-files-o', 'yellow')->to($row);
    GUI::infoWidget('LIKES', '93,139', 'fa fa-star-o', 'red')->to($row);

    // Form
    $form = GUI::form([
        'url' => 'form'
    ])->to($window);

    // Row
    $row = GUI::row('col-md-6', 'col-md-6')->to($form);

    // Accordion
    $box = GUI::box('Accordion', 'success')->to($row);

    $accordion = GUI::accordion()
        ->to($box)
        ->active(2);

    GUI::collapsible('Default Block')->to($accordion)->add(GUI::tag('p', 'Block 1'));
    GUI::collapsible('Success Block [Selected]', 'success')->to($accordion)->add(GUI::tag('p', 'Block 2'));
    GUI::collapsible('Info Block', 'info')->to($accordion)->add(GUI::tag('p', 'Block 3'));
    GUI::collapsible('Warning Block', 'warning')->to($accordion)->add(GUI::tag('p', 'Block 4'));
    GUI::collapsible('Danger Block', 'danger')->to($accordion)->add(GUI::tag('p', 'Block 5'));

    // Tabs
    $tabs = GUI::tabs('Tabs Heading', 'fa fa-th')->to($row);

    // Tabs tools
    GUI::tag('a', GUI::icon('fa fa-gear'))
        ->toTools($tabs)
        ->attr('href', 'javascript:alert(\'You clicked me !\')');

    // Tab 1 - Alerts
    $tab = GUI::tab('Alerts')->to($tabs);
    GUI::alert("Success", "success")->to($tab);
    GUI::alert("Success", "success", "Success with description")->to($tab);
    GUI::alert("Warning", "warning")->to($tab);
    GUI::alert("Warning", "warning", "Warning with description")->to($tab);
    GUI::alert("Info", "info")->to($tab);
    GUI::alert("Info", "info", "Info with description")->to($tab);
    GUI::alert("Danger", "danger")->to($tab);
    GUI::alert("Danger", "danger", "Danger with description")->to($tab);

    // Tab 2 - Callouts
    $tab = GUI::tab('Callouts')->to($tabs);
    GUI::callout('Success Callout', 'success')->to($tab);
    GUI::callout('Success Callout', 'success', 'Success calout with description.')->to($tab);
    GUI::callout('Info Callout', 'info')->to($tab);
    GUI::callout('Info Callout', 'info', 'Info calout with description.')->to($tab);
    GUI::callout('Warning Callout', 'warning')->to($tab);
    GUI::callout('Warning Callout', 'warning', 'Warning calout with description.')->to($tab);
    GUI::callout('Danger Callout', 'danger')->to($tab);
    GUI::callout('Danger Callout', 'danger', 'Danger calout with description.')->to($tab);

    // Tab 3 - Table
    $tab = GUI::tab('Table')->to($tabs);

    $table = GUI::table()
        ->to($tab)
        ->addColumns([ 'Názov', 'Možnosti' ]);

    foreach (Serenity\Region::take(1)->get() as $region)
    {
        $table->addRow([$region->name, '<a href="#">Upraviť</a>'])
            ->id($region->id)
            ->sortgroup('region')
            ->model('Serenity\Region');

        foreach ($region->districts as $district)
        {
            $table->addRow([$district->name, '<a href="#">Upraviť</a>'])
                ->id($district->id)
                ->level(1)
                ->sortgroup('region_district_' . $region->id)
                ->model('Serenity\District');
        }
    }

    // Tab 4 - Progress Bars
    $tab = GUI::tab('Progress Bars')->to($tabs);
    GUI::progressBar(20, 'info', true)->to($tab);
    GUI::progressBar(40, 'danger', true)->to($tab);
    GUI::progressBar(50, 'success', false)->to($tab);
    GUI::progressBar(60, 'warning', false)->to($tab);
    GUI::progressBar(70, 'primary', false)->to($tab);

    // Tab 5 - HTML
    $tab = GUI::tab('HTML')->to($tabs);

    GUI::HTML('HTML test. And this is <strong>strong</strong>.')->to($tab);

    $tagContainer = GUI::tagContainer()->to($tab);
    $tagContainer->addClass('well');

    GUI::HTML('Im content in <code>.well</code>.')->to($tagContainer);

    // Tab 6 - Editor
    $tab = GUI::tab('Editor')->to($tabs);

    $editor = GUI::editor()->to($tab);

    // Tab 7 - Buttons
    $tab = GUI::tab('Buttons')->to($tabs);

    GUI::button('Test button')->to($tab);

    GUI::button('Click me!', 'danger', 'a', 'xs')
        ->attr('href', '#yeah-you-clicked-me')
        ->attr('onclick', 'alert(\'Hello world!\')')
        ->to($tab);

    GUI::buttonApplication('Content', 'a', 'fa fa-bar-chart-o', 321, 'aqua')
        ->attr('onClick', 'alert(\'hello man\')')
        ->to($tab);

    $buttonGroup = GUI::buttonGroup()->to($tab);

    GUI::button(GUI::icon('fa fa-align-left'), 'success')->to($buttonGroup);
    GUI::button(GUI::icon('fa fa-align-center'), 'primary')->to($buttonGroup);
    GUI::button(GUI::icon('fa fa-align-right'), 'danger')->to($buttonGroup);

    GUI::button('Action')->to($tab);
    GUI::buttonDropdown()->to($buttonGroup);
    GUI::dropdown()->to($buttonGroup)
        ->add(GUI::dropdownItem('Action', '#action'))
        ->add(GUI::dropdownDivider())
        ->add(GUI::dropdownItem('Do something', '#do-something'))
        ->add(GUI::dropdownItem('Test'));

    $tagContainer = GUI::tagContainer()->to($tab);

    GUI::button(GUI::icon('fa fa-google-plus'))
        ->set('social', 'google-plus')
        ->to($tagContainer);

    GUI::buttonSocial('google-plus', 'Join us on Instagram', 'fa fa-instagram')
        ->to($tagContainer);

    GUI::buttonSocial('google-plus', 'Join us on Google Plus')
        ->to($tagContainer);

    GUI::buttonSocial('google-plus')
        ->to($tagContainer);

    GUI::buttonSocial('facebook')
        ->to($tagContainer);

    // Forms

    // Quick Example
    $box = GUI::box('Quick Example', 'primary')->to($row);

    // Email address
    GUI::email()
        ->label("Email address")
        ->name("exampleInputEmail1")
        ->id("exampleInputEmail1")
        ->placeholder("Enter email")
        ->to($box);

    GUI::password()
        ->label("Password")
        ->name("exampleInputPassword1")
        ->id("exampleInputPassword1")
        ->placeholder("Password")
        ->to($box);

    GUI::file()
        ->label("File input")
        ->name("exampleInputFile")
        ->id("exampleInputFile")
        ->placeholder("Password")
        ->help("Example block-level help text here.")
        ->to($box);

    GUI::checkbox()
        ->label("Check me out")
        ->name("check_me")
        ->to($box);

    GUI::submit("Submit")
        ->toFooter($box);

    // General Elements
    $box = GUI::box('General Elements', 'warning')->to($row);

    GUI::input()
        ->label("Text")
        ->placeholder("Enter ...")
        ->to($box);

    GUI::input()
        ->label("Text Disabled")
        ->placeholder("Enter ...")
        ->disabled(true)
        ->to($box);

    GUI::textarea()
        ->label("Textarea")
        ->placeholder("Enter ...")
        ->to($box);

    GUI::textarea()
        ->label("Textarea")
        ->placeholder("Enter ...")
        ->disabled(true)
        ->to($box);

    GUI::input()
        ->label("Input with success")
        ->hasSuccess()
        ->placeholder("Enter ...")
        ->to($box);

    GUI::input()
        ->label("Input with warning")
        ->hasWarning()
        ->placeholder("Enter ...")
        ->to($box);

    GUI::input()
        ->label("Input with error")
        ->hasError()
        ->placeholder("Enter ...")
        ->to($box);

    GUI::checkbox()
        ->label("Checkbox 1")
        ->value(true)
        ->to($box);

    GUI::checkbox()
        ->label("Checkbox 2")
        ->to($box);

    GUI::checkbox()
        ->label("Checkbox disabled")
        ->disable()
        ->to($box);

    GUI::radio()
        ->check()
        ->name("radio_group")
        ->label("Option one is this and that—be sure to include why it's great")
        ->to($box);

    GUI::radio()
        ->name("radio_group")
        ->label("Option two can be something else and selecting it will deselect option one")
        ->to($box);

    GUI::radio()
        ->name("radio_group")
        ->label("Option three is disabled")
        ->disable()
        ->to($box);

    GUI::select()
        ->label("Select")
        ->name("select")
        ->options([
            "option_1" => "option 1",
        ])
        ->to($box);

    GUI::select()
        ->label("Select Disabled")
        ->name("select_disabled")
        ->options([
            "option_1" => "option 1",
        ])
        ->disable()
        ->to($box);

    GUI::select()
        ->label("Select Multiple")
        ->name("select_multiple")
        ->placeholder("test")
        ->options([
            "Voľaka skupina" => [
                "option_1" => "option 1",
                "option_2" => "option 2",
            ],
            "Inakša skupina" => [
                "option_3" => "option 3",
                "option_4" => "option 4",
            ],
        ])
        ->value([
            'option_1',
            'option_3',
        ])
        ->multiple()
        ->to($box);

    GUI::select()
        ->label("Select Multiple Disabled")
        ->name("select_multiple_disabled")
        ->options([
            "option_1" => "option 1",
            "option_2" => "option 2",
            "option_3" => "option 3",
            "option_4" => "option 4",
            "option_5" => "option 5",
        ])
        ->multiple()
        ->disable()
        ->to($box);

    // Different Height
    $box = GUI::box('Different Height', 'success')->to($row);

    GUI::input()
        ->placeholder(".input-lg")
        ->height('large')
        ->to($box);

    GUI::input()
        ->placeholder("Default input")
        ->to($box);

    GUI::input()
        ->placeholder(".input-sm")
        ->height('small')
        ->to($box);

    // Empty
    GUI::blank()->to($row);

    // Different Width
    $box = GUI::box('Different Width', 'danger')->to($row);

    $boxRow = GUI::row('col-xs-3', 'col-xs-4', 'col-xs-5')
        ->to($box);

    GUI::input()
        ->placeholder(".col-xs-3")
        ->to($boxRow);

    GUI::input()
        ->placeholder(".col-xs-4")
        ->to($boxRow);

    GUI::input()
        ->placeholder(".col-xs-5")
        ->to($boxRow);

    // Empty
    GUI::blank()->to($row);

    // Editor
    $box = GUI::box('Wysiwyg Editor', 'success')->to($row);
    $editor = GUI::editor()->to($box);

    // Render
    return $window->render();

});

Route::get('filemanager', function() {

    // Window
    $window = GUI::window([
        'title' => 'Serenity CMS',
        'logo_text' => 'Serenity CMS',
        'mini_logo_text' => 'SCMS',
        'logo_href' => URL::to(''),
        'heading' => 'Serenity CMS',
        'heading_small' => 'File Manager',
        'webURL' => URL::to(''),
        'logoutURL' => URL::to('login'),
    ]);

    $filemanager = GUI::filemanager()->to($window);

    // Render
    return $window->render();

});

Route::get('editor', function() {

    // Window
    $window = GUI::window([
        'title' => 'Serenity CMS',
        'logo_text' => 'Serenity CMS',
        'mini_logo_text' => 'SCMS',
        'logo_href' => URL::to(''),
        'heading' => 'Serenity CMS',
        'heading_small' => 'Wysiwyg Editor',
        'webURL' => URL::to(''),
        'logoutURL' => URL::to('login'),
    ]);

    $box = GUI::box('Wysiwyg Editor', 'success')->to($window);

    $editor = GUI::editor()->to($box);

    // Render
    return $window->render();

});

Route::get('table', function() {

    $window = GUI::window([
        'title' => 'Serenity CMS',
        'logo_text' => 'Serenity CMS',
        'mini_logo_text' => 'SCMS',
        'logo_href' => URL::to(''),
        'heading' => 'Serenity CMS',
        'heading_small' => 'Tables',
    ]);

    $box = GUI::box('Obyčajná statická tabuľka', 'primary')->to($window);

    // Table
    $table = GUI::table()
        ->to($box)
        ->addColumns([ 'Názov', 'Možnosti' ]);

    foreach (Serenity\Region::all() as $region)
    {
        $table->addRow([$region->name, '<a href="#">Upraviť</a>'])
            ->id($region->id)
            ->sortgroup('region')
            ->model('Serenity\Region');

        foreach ($region->districts as $district)
        {
            $table->addRow([$district->name, '<a href="#">Upraviť</a>'])
                ->id($district->id)
                ->level(1)
                ->sortgroup('region_district_' . $region->id)
                ->model('Serenity\District');
        }
    }

    return $window->render();

});

Route::get('login', function() {
    return GUI::login([
        'title' => 'SerenityCMS',
        'heading' => '<cite>Ak môžeš ísť k rieke, nechoď k džbánu.</cite><br>Leonardo Da Vinci',
        'logo' => '<strong>Serenity</strong>CMS',
        'favicon' => config('admin.favicon'),
        'fieldLoginName' => 'name',
        'fieldPasswordName' => 'password',
        'webURL' => URL::to(''),
        'form' => [
            'url' => URL::to(''),
        ],
        'showError' => true,
    ]);
});

Route::get('form', function() {
    $window = GUI::window([
        'favicon' => config('admin.favicon'),
        'heading' => 'General Form Elements',
        'heading_small' => 'Preview',
        'logo_text' => '<strong>Admin</strong>LTE',
        'logo_href' => URL::to(''),
        'title' => 'Some title here',
    ]);

    $form = GUI::form([
        'url' => 'form'
    ])->to($window);

    $row = GUI::row('col-md-6', 'col-md-6')->to($form);

    // Quick Example
    $box = GUI::box('Quick Example', 'primary')->to($row);

    // Email address
    GUI::email()
        ->label("Email address")
        ->name("exampleInputEmail1")
        ->id("exampleInputEmail1")
        ->placeholder("Enter email")
        ->to($box);

    GUI::password()
        ->label("Password")
        ->name("exampleInputPassword1")
        ->id("exampleInputPassword1")
        ->placeholder("Password")
        ->to($box);

    GUI::file()
        ->label("File input")
        ->name("exampleInputFile")
        ->id("exampleInputFile")
        ->placeholder("Password")
        ->help("Example block-level help text here.")
        ->to($box);

    GUI::checkbox()
        ->label("Check me out")
        ->name("check_me")
        ->to($box);

    GUI::submit("Submit")
        ->toFooter($box);

    // General Elements
    $box = GUI::box('General Elements', 'warning')->to($row);

    GUI::input()
        ->label("Text")
        ->placeholder("Enter ...")
        ->to($box);

    GUI::input()
        ->label("Text Disabled")
        ->placeholder("Enter ...")
        ->disabled(true)
        ->to($box);

    GUI::textarea()
        ->label("Textarea")
        ->placeholder("Enter ...")
        ->to($box);

    GUI::textarea()
        ->label("Textarea")
        ->placeholder("Enter ...")
        ->disabled(true)
        ->to($box);

    GUI::input()
        ->label("Input with success")
        ->hasSuccess()
        ->placeholder("Enter ...")
        ->to($box);

    GUI::input()
        ->label("Input with warning")
        ->hasWarning()
        ->placeholder("Enter ...")
        ->to($box);

    GUI::input()
        ->label("Input with error")
        ->hasError()
        ->placeholder("Enter ...")
        ->to($box);

    GUI::checkbox()
        ->label("Checkbox 1")
        ->value(true)
        ->to($box);

    GUI::checkbox()
        ->label("Checkbox 2")
        ->to($box);

    GUI::checkbox()
        ->label("Checkbox disabled")
        ->disable()
        ->to($box);

    GUI::radio()
        ->check()
        ->name("radio_group")
        ->label("Option one is this and that—be sure to include why it's great")
        ->to($box);

    GUI::radio()
        ->name("radio_group")
        ->label("Option two can be something else and selecting it will deselect option one")
        ->to($box);

    GUI::radio()
        ->name("radio_group")
        ->label("Option three is disabled")
        ->disable()
        ->to($box);

    GUI::select()
        ->label("Select")
        ->name("select")
        ->options([
            "option_1" => "option 1",
        ])
        ->to($box);

    GUI::select()
        ->label("Select Disabled")
        ->name("select_disabled")
        ->options([
            "option_1" => "option 1",
        ])
        ->disable()
        ->to($box);

    GUI::select()
        ->label("Select Multiple")
        ->name("select_multiple")
        ->placeholder("test")
        ->options([
            "Voľaka skupina" => [
                "option_1" => "option 1",
                "option_2" => "option 2",
            ],
            "Inakša skupina" => [
                "option_3" => "option 3",
                "option_4" => "option 4",
            ],
        ])
        ->value([
            'option_1',
            'option_3',
        ])
        ->multiple()
        ->to($box);

    GUI::select()
        ->label("Select Multiple Disabled")
        ->name("select_multiple_disabled")
        ->options([
            "option_1" => "option 1",
            "option_2" => "option 2",
            "option_3" => "option 3",
            "option_4" => "option 4",
            "option_5" => "option 5",
        ])
        ->multiple()
        ->disable()
        ->to($box);

    // Different Height
    $box = GUI::box('Different Height', 'success')->to($row);

    GUI::input()
        ->placeholder(".input-lg")
        ->height('large')
        ->to($box);

    GUI::input()
        ->placeholder("Default input")
        ->to($box);

    GUI::input()
        ->placeholder(".input-sm")
        ->height('small')
        ->to($box);

    // Empty
    GUI::blank()->to($row);

    // Different Width
    $box = GUI::box('Different Width', 'danger')->to($row);

    $boxRow = GUI::row('col-xs-3', 'col-xs-4', 'col-xs-5')
        ->to($box);

    GUI::input()
        ->placeholder(".col-xs-3")
        ->to($boxRow);

    GUI::input()
        ->placeholder(".col-xs-4")
        ->to($boxRow);

    GUI::input()
        ->placeholder(".col-xs-5")
        ->to($boxRow);

    GUI::blank()->to($row);

    GUI::infoWidget('Likes', '184', 'fa fa-thumbs-o-up', 'red')->to($row);

    GUI::blank()->to($row);

    /*GUI::progressBox([
        'bg' => 'green',
        'icon' => 'fa fa-thumbs-o-up',
        'heading' => "Likes",
        'content' => "184",
        'value' => 75,
        'progress' => "Test",
    ])->to($row);*/

    // Render window
    return $window->render();
});

// Front
Route::get('/old', function() {

    /*
        Chcem spracovat
        ===============
[-]         Login screen
[-]         formulare
            tabulky
            wysiwyg
            filemanager (elfinder ?)

[-]         infoboxy
[-]         https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#component-info-box

            modals
            https://almsaeedstudio.com/themes/AdminLTE/pages/UI/modals.html


        Nespracovane
        ============
            window tools (tie veci uplne napravo hore take vyskakovacie)
            Charts (grafy)
            Carousel
            Typography
    */

    $window = GUI::window([
        'heading' => 'Widgets',
        'heading_small' => 'Preview page',
        'logo_text' => '<strong>Admin</strong>LTE',
        'logo_href' => URL::to(''),
        'title' => 'Some title here',
    ]);

    $window->breadcrumbs = [
        [GUI::icon('fa fa-dashboard') . ' Home', URL::to('admin')],
        ['Dashboard', URL::to('admin')],
    ];

    // Footer
    GUI::tag('strong', 'Copyright &copy; 2014-2015. All rights reserved.')
    ->toFooter($window);

    GUI::userPanel([
        'title' => 'Hello, Jane',
        'state' => 'Online',
        'href' => URL::to('admin'),
        'image' => 'https://almsaeedstudio.com/themes/AdminLTE/dist/img/user2-160x160.jpg',
    ])->toSidebar($window);

    GUI::searchForm([
        'action' => '#',
        'method' => 'get',
        'name' => 'q',
        'placeholder' => 'Search...',
    ])->toSidebar($window);

    // Menu

    $sidebarMenu = GUI::sidebarMenu()->toSidebar($window);

    GUI::sidebarMenuHeader('MAIN NAVIGATION')->to($sidebarMenu);

    GUI::sidebarMenuLink([
        'text' => 'Dashboard',
        'icon' => 'fa fa-dashboard',
    ])->to($sidebarMenu)->attr('href', '#');

    GUI::sidebarMenuLink([
        'text' => 'Widgets',
        'icon' => 'fa fa-th',
        'badge' => 'new',
        'badgeBg' => 'green',
    ])->to($sidebarMenu)->attr('href', '#');

    $sidebarMenuTreeview = GUI::sidebarMenuTreeview([
        'text' => 'Charts',
        'icon' => 'fa fa-bar-chart-o',
    ])->to($sidebarMenu);

    GUI::sidebarMenuLink([
        'text' => 'Sublink',
        'icon' => 'fa fa-circle-o',
    ])->to($sidebarMenuTreeview)->attr('href', '#');

    $sidebarMenuTreeview2 = GUI::sidebarMenuTreeview([
        'text' => 'Charts 2',
        'icon' => 'fa fa-circle-o',
    ])->to($sidebarMenuTreeview);

    GUI::sidebarMenuLink([
        'text' => 'Sublink 2',
        'icon' => 'fa fa-circle-o',
    ])->to($sidebarMenuTreeview2)->attr('href', '#');

    GUI::sidebarMenuHeader('LABELS')->to($sidebarMenu);

    GUI::sidebarMenuLink([
        'text' => 'Important',
        'icon' => 'fa fa-circle-o text-danger',
    ])->to($sidebarMenu)->attr('href', '#');

    GUI::sidebarMenuHeader('FORMS')->to($sidebarMenu);

    GUI::sidebarMenuLink([
        'text' => 'Basic',
        'icon' => 'fa fa-circle-o text-info',
    ])->to($sidebarMenu)->attr('href', URL::to('form'));

    GUI::sidebarMenuHeader('OTHER PAGES')->to($sidebarMenu);

    GUI::sidebarMenuLink([
        'text' => 'Login screen',
        'icon' => 'fa fa-sign-in text-success',
    ])->to($sidebarMenu)->attr('href', URL::to('login'));

    GUI::header([
        'heading' => 'AdminLTE Small Boxes',
        'subheading' => 'Small boxes are used for viewing statistics. To create a small box use the class <code>.small-box</code> and mix & match using the <code>bg-*</code> classes.',
    ])->to($window);

    // Row
    $row = GUI::row('col-lg-3 col-xs-6', 'col-lg-3 col-xs-6', 'col-lg-3 col-xs-6', 'col-lg-3 col-xs-6')->to($window);

    GUI::smallBox([
        'bgColor' => 'aqua',
        'bgIcon' => 'ion ion-bag',
        'heading' => '150',
        'text' => 'New Orders',
        'buttonText' => 'More info',
        'buttonHref' => '#',
    ])->to($row);

    GUI::smallBox([
        'bgColor' => 'green',
        'bgIcon' => 'ion ion-stats-bars',
        'heading' => '53<sup style="font-size: 20px">%</sup>',
        'text' => 'Bounce Rate',
        'buttonText' => 'More info',
        'buttonHref' => '#',
    ])->to($row);

    GUI::smallBox([
        'bgColor' => 'yellow',
        'bgIcon' => 'ion ion-person-add',
        'heading' => '44',
        'text' => 'User Registrations',
        'buttonText' => 'More info',
        'buttonHref' => '#',
    ])->to($row);

    GUI::smallBox([
        'bgColor' => 'red',
        'bgIcon' => 'ion ion-pie-graph',
        'heading' => '65',
        'text' => 'Unique Visitors',
        'buttonText' => 'More info',
        'buttonHref' => '#',
    ])->to($row);

    $box = GUI::box([
        'solid' => true,
        'bg' => 'navy',
        'state' => 'warning',
        'title' => 'Dávaj pozor',
        'icon' => 'fa fa-warning',
    ])->to($window);

    GUI::HTML('Už ňemosíš')->to($box);

    GUI::alert([
        'state' => 'danger',
        'icon' => 'fa fa-ban',
        'content' => 'danger',
    ])->to($window);

    GUI::alertDanger('Bacha !')->to($window);
    GUI::alertInfo('Nejaké informácie !')->to($window);
    GUI::alertWarning('Opatrne !')->to($window);
    GUI::alertSuccess('Výborne !')->to($window);

    GUI::callout('Heading', 'danger', 'danger')->to($window);
    GUI::calloutDanger('Danger')->to($window);
    GUI::calloutInfo('Info')->to($window);
    GUI::calloutWarning('Warning', 'aa')->to($window);

    $tabs = GUI::tabs([
        'title' => 'Tabs Heading',
        'icon' => 'fa fa-th',
    ])->to($window);

    $tab = GUI::tab('Nadpis')->to($tabs);
    GUI::HTML("Ahoj")->to($tab);

    $tab = GUI::tab('Nenadpis')->to($tabs);
    GUI::HTML("Nazdar")->to($tab);

    $box = GUI::box([
        'title' => 'Akordeón',
    ])->to($window);
    $accordion = GUI::accordion()->to($box);

    GUI::collapsible('Ahoj')->to($accordion)->add(GUI::HTML('Test 1'));
    GUI::collapsible('Ta co ?', 'danger')->to($accordion)->add(GUI::HTML('Test 2'));
    GUI::collapsible('Ta nič ?')->to($accordion)->add(GUI::HTML('Test 3'));

    GUI::tag('a', 'click here')->attr('href', '#clicked')->to($window);

    GUI::progressBar([
        'state' => 'primary',
        'value' => 100,
    ])->to($window);

    GUI::button('Clicke me!', 'danger', 'a', 'xs')
        ->attr('href', '#yeah-you-clicked-me')
        ->attr('onclick', 'alert(\'Hello world!\')')
        ->to($window);

    GUI::buttonApplication('Content', 'a', 'fa fa-bar-chart-o', 321, 'aqua')
        ->attr('onClick', 'alert(\'hello man\')')
        ->to($window);

    $buttonGroup = GUI::buttonGroup()->to($window);

    GUI::button(GUI::icon('fa fa-align-left'), 'success')->to($buttonGroup);
    GUI::button(GUI::icon('fa fa-align-center'), 'primary')->to($buttonGroup);
    GUI::button(GUI::icon('fa fa-align-right'), 'danger')->to($buttonGroup);

    $buttonGroup = GUI::buttonGroup()->to($window);

    GUI::button('Action')->to($buttonGroup);
    GUI::buttonDropdown()->to($buttonGroup);
    GUI::dropdown()->to($buttonGroup)
        ->add(GUI::dropdownItem('Action', '#action'))
        ->add(GUI::dropdownDivider())
        ->add(GUI::dropdownItem('Do something', '#do-something'))
        ->add(GUI::dropdownItem('Test'));

    GUI::button(GUI::icon('fa fa-google-plus') . 'Test')
        ->set('social', 'google-plus')
        ->to($window);

    GUI::buttonSocial('google-plus', 'Join us on Instagram', 'fa fa-instagram')
        ->to($window);

    GUI::buttonSocial('google-plus', 'Join us on Google Plus')
        ->to($window);

    GUI::buttonSocial('google-plus')
        ->to($window);

    return $window->render();

});

/*
// Admin login
Route::controller('admin/login', 'LoginController');

// Admin sections
Route::group(array('prefix' => Config::get('admin.url_prefix'), 'before' => 'auth.admin'), function()
{
    // Admin logout
    Route::get('logout', 'LoginController@logout');

    // Admins
    Route::resource('admins', 'AdminsController', array('except' => 'show'));

    // Page types
    Route::resource('page-types', 'PageTypesController', array('except' => 'show'));

    // Page type variables
    Route::get('page-type-variables/create/{id}', 'PageTypeVariablesController@create');
    Route::post('page-type-variables', 'PageTypeVariablesController@store');
    Route::get('page-type-variables/{id}/edit', 'PageTypeVariablesController@edit');
    Route::match(array('PUT', 'PATCH'), 'page-type-variables/{id}', 'PageTypeVariablesController@update');
    Route::delete('page-type-variables/{id}', 'PageTypeVariablesController@destroy');

    // Dashboard
    Route::get('/', 'DashboardController@index');
});
*/
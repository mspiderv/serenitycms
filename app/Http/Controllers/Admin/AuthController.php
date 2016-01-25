<?php

namespace Serenity\Http\Controllers\Admin;

use App;
use GUI;
use URL;
use Validator;
use Serenity\User;
use Serenity\Http\Controllers\AbstractController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends AbstractController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the authentication of existing users.
    |
    */

    use AuthenticatesUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Where to redirect users
        $this->redirectTo = App::getAdminPrefix();
        $this->redirectAfterLogout = URL::route('admin.login');

        $this->middleware('admin.guest', ['except' => 'getLogout']);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return GUI::login([
            'title' => config('serenity.name'),
            'heading' => config('serenity.admin.loginHeading'),
            'logo' => config('serenity.admin.logo.text'),
            'favicon' => config('serenity.admin.favicon'),
            'fieldLoginName' => 'name',
            'fieldPasswordName' => 'password',
            'webURL' => URL::to(App::getFrontPrefix()),
            'form' => [
                'route' => 'admin.login.post',
            ],
            'showError' => false,
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return 'name';
    }
}

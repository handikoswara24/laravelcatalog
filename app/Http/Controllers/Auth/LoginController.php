<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getToken(Request $request)
    {
        $clientSecret = "1W34UZDrM2coib1TsbxvTVTlIJPHi64468bGZeSt";

        $request->request->add([
            "grant_type" => "password",
            "client_id" => "92b63c06-a71e-4748-9284-40f8e70906c3",
            "client_secret" => $clientSecret,
            "username" => $request->username,
            "password" => $request->password
        ]);

        $requestToken = Request::create(env("APP_URL") . "/oauth/token", 'post');
        $response = Route::dispatch($requestToken);

        return $response;
    }
}

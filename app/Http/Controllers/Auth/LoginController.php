<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'exists:users,' . $this->username(),
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        if (Auth::viaRemember()){
            return array_merge($request->only($this->username(), 'password', 'remember'));
        }else{
            return array_merge($request->only($this->username(), 'password'));
        }
    }

    protected function redirectTo()
    {
        $user = Auth::user();

        if($user->profil_id == 1){
            return '/admin/dashboard';
        }else{
            return '/dashboard';
        }

    }
}

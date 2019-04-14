<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class CoordenadorLoginController extends Controller
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

    protected $redirectTo = '/coordenador';

    protected $guard = 'coordenador';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:coordenador')->except('logout');
    }

    public function showLogin() {
        return view('auth.coordenador.login');
    }

    public function login(Request $request) {
        if(Auth::guard('coordenador')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('coordenador.dashboard');
            // return redirect()->intended(route('coordenador.dashboard'));
            // dd(Auth::guard('coordenador')->user());
        }
        // return redirect()->back()->withInput($request->only('email'))->with('error', 'Falha ao realizar login');
        return dd('abc');
    }
}
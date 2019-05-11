<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Validator;

class ProfessorLoginController extends Controller
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

    protected $redirectTo = '/professor';

    protected $guard = 'professor';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:professor')->except('logout');
    }

    public function showLogin() {
        return view('auth.professor.login');
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|email',
            'password' => 'required',
        ]);

        if(Auth::guard('professor')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('professor.dashboard'));
        }

        $validator->errors()->add('email', 'Essas credenciais não correspondem aos nossos registros.');

        return redirect()->back()->withInput($request->only('email'))->withErrors($validator);
    }
}
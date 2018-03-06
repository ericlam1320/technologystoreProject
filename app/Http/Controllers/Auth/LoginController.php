<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use App\Http\Requests\LoginRequest;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLogin(){
        return view('adminDashboard.login');
    }
    public function postLogin(LoginRequest $request){
        $login = array(
            'Email' => $request->username,
            'MatKhau' => $request->password,
            'KichHoat'=> 1
        );
        if(Auth::attempt($login)){
            //return redirect()->route('dashboard');
            echo "a";
        }else{
            //return redirect()->back();
            echo "b";
        }
    }
}

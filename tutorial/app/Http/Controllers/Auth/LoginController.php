<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;

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

    public function login(Request $request)
    {

        $user = $request->all();
        print_r($user);
        $this->validateLogin($request);

        if ($user = $this->attemptLogin($request)) {
            //$user = $this->guard()->user();
            //$user->generateToken();

            echo "login good";

            return response()->json([
                'data' => $user->toArray(),
            ],200);

            
        }

        echo "login bad";

        //return $this->sendFailedLoginResponse($request);
    }

    private function attemptLogin(Request $request){
        $loginInfo = $request->all();
        $user = User::where('email', $loginInfo['email'])->first();
        echo "user from db";
        print_r($user);
        if($loginInfo['password']==$user['password']){

            return $user;
        }
        return false;
    }
}

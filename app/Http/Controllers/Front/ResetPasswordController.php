<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Auth\Events\PasswordReset;


use Illuminate\Http\Request;



use Password;
use Str;

use Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:client-web');
    }

    protected function broker() {
        return Password::broker('clients');
    }


    protected function guard() {
        return Auth::guard('client-web');
    }



    



    public function showResetForm(Request $request, $token = null)
    {
        return view('front.change-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }


	public function resetPassword($user, $password) {
        // $user->password = Hash::make($password);
        $user->password = $password;

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }


}

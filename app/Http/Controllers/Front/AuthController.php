<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class AuthController extends Controller
{

	public function __construct() {
		$this->middleware('guest:client-web');
	}



	public function showRegisterForm() {
		return view('front.sign-up');
	}


	public function register() {

	}

    
	public function showLoginForm() {
		return view('front.login');
	}


	public function login(Request $request) {
		//dd($request->all());
		//1.validation
		$request->validate([
			'phone'=> 'required|regex:/[0-9 ]+/|size:11',
			'password' => 'required|min:6'
		],
		[
			'phone.required' => 'رقم الجوال مطلوب',
			'password.required' => 'كلمة المرور مطلوبة',
 		]);


		$credentials = [
			'phone' => $request->phone,
			'password' => $request->password
		];

		//2.attempt to log the user in
		if(Auth::guard('client-web')->attempt($credentials, $request->remember)) {
			//successful , redirect to their intended url
			flash()->success('Logged in successfully');
			return redirect()->intended(route('home'));
		}

		//failed, redirect to login page with form data
		flash()->error('خطأ ببيانات تسجيل الدخول');
		return redirect()->back()->withInput($request->only('phone', 'remember'));
	}


}

<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BloodType;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Client;

use Auth;

class AuthController extends Controller
{

	public function __construct() {
		$this->middleware('guest:client-web', ['except' => ['logout']]);
	}



	public function showRegisterForm() {
		$blood_types = BloodType::all();
		$governorates = Governorate::all();
		return view('front.register', compact('blood_types', 'governorates'));
	}


	public function register(Request $request) {
		//Y-n-j date format example:  1991-1-1
    	//Y-m-d date format example:  1991-01-01
    	// dd($request->all());
    	$rules = [
    		'name' 				  =>  'required|min:3|max:100',
    		'email' 			  =>  'required|email|unique:clients',
    		'date_of_birth' 	  =>  'required|date_format:Y-n-j|before:13 years ago',
    		'blood_type_id' 	  =>  'required|integer|exists:blood_types,id',
    		'last_donation_date'  =>  'required|date_format:Y-n-j|before_or_equal:today',
    		'city_id' 			  =>  'required|integer|exists:cities,id',
    		'phone' 			  =>  'required|unique:clients|regex:/(01)[0-9]{9}/|size:11',
    		'password' 			  =>  'required|confirmed|min:6',
    		//only to populate cities in web version of register form
    		'governorate_id' 	  =>  'required|integer|exists:governorates,id',
    	];

    	$this->validate($request, $rules);

    	$client = Client::create($request->all());
    	$client->api_token = str_random(60);
    	$client->save();
    	
    	if($client) {
    		
    		Auth::guard('client-web')->login($client);

    		flash()->success('تم إنشاء حساب جديد ونسجيل دخولك بنجاح');

       		return redirect(route('home'));
    	}

    	flash()->error('We are sorry, something went wrong. Please try again!');

    	$requestBack = clone $request;
    	unset($requestBack->password);
    	unset($requestBack->password_confirmation);
    	return redirect(route('clientsRegister'))->withInput($requestBack->all());
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
			flash()->success('تم تسجيل الدخول بنجاح');
			return redirect()->intended(route('home'));
		}

		//failed, redirect to login page with form data
		flash()->error('خطأ ببيانات تسجيل الدخول');
		return redirect()->back()->withInput($request->only('phone', 'remember'));
	}


	public function logout(Request $request)
    {
    	// dd('logout');
        // $request->session()->forget(Auth::guard('client-web')->user());

        Auth::guard('client-web')->logout();

        return redirect('home');
    }


}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



use App\Models\Client;
use App\Models\City;
use App\Models\NotificationToken;


use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rule;


use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordReset;




class AuthController extends Controller
{
    

    public function register(Request $request) {

    	//Y-n-j date format example:  1991-1-1
    	//Y-m-d date format example:  1991-01-01
    	$rules = [
    		'name' 				  =>  'required|min:3|max:100',
    		'email' 			  =>  'required|email|unique:clients',
    		'date_of_birth' 	  =>  'required|date_format:Y-n-j|before:13 years ago',
    		'blood_type_id' 	  =>  'required|integer|exists:blood_types,id',
    		'last_donation_date'  =>  'required|date_format:Y-n-j|before_or_equal:today',
    		'city_id' 			  =>  'required|integer|exists:cities,id',
    		'phone' 			  =>  'required|unique:clients|regex:/(01)[0-9]{9}/|size:11',
    		'password' 			  =>  'required|confirmed'
    	];

    	$validator = validator()->make($request->all(), $rules);


    	if($validator->fails()) {
    		return responseJson(0, $validator->errors()->first(), $validator->errors());
    	}



    	//$request->merge(['password' => bcrypt($request->password)]);
    	$client = Client::create($request->all());
    	$client->api_token = str_random(60);
    	$client->save();




        /**** Initial setting of notification_settings 
        - according to chosen bloodType and governorate ****/
        // $client->bloodTypes()->attach($request->blood_type_id);
        // $client->governorates()->attach(City::where('id', $client->city_id)->first()->governorate->id);



    	return responseJson(1, 'تم التسجيل بنجاح', [
    		'api_token' => $client->api_token,
    		'client'    => $client
    	]);
    	
    }




    public function login(Request $request) {


    	$rules = [
    		'phone' 	=>  'required|regex:/(01)[0-9]{9}/',
    		'password'  =>  'required'
    	];


    	$validator = validator()->make($request->all(), $rules);


    	if($validator->fails()) {
    		return responseJson(0, $validator->errors()->first(), $validator->errors());
    	}


		$client = Client::where('phone', $request->phone)->first();

		if($client) {
			if(Hash::check($request->password, $client->password)) {
				return responseJson(1, 'تم تسجيل الدخول بنجاح', [
					'api_token' =>  $client->api_token,
					'client'    =>  $client
				]);
			}
		}
    	
    	return responseJson(0, 'خطأ ببيانات تسجيل الدخول');

    }




    public function resetPassword(Request $request) {

        $validator = validator()->make($request->all(), [
            'phone' => 'required|regex:/(01)[0-9]{9}/|size:11'
        ]);

        if($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        $client = Client::where('phone', $request->phone)->first();
        

        if($client) {

            $code = rand(1111,9999);

            $update = $client->update(['pin_code' => $code]);


            if($update) {

                //send code via sms
                /*   --- example ---
                    smsMisr($request->phone, "Your reset code is: ".$code);
                    //TODO: check for success or fail ....
                */
                
                //send code via email
                Mail::to($client->email)
                    ->bcc('amiraelkholy16@gmail.com')
                    ->send(new PasswordReset($client));


                return responseJson(1, 'افحص إيميلك من أجل الكود', [
                                            'pin_code_for_test' => $code,
                                            'mail_fails' => mail::failures(),
                                            'client email' => $client->email
                                        ]);
            }
            else {
                return responseJson(0, 'حدث خطأ ، برجاء المحاولة مرة أخرى');
            }
        }
        else {
            return responseJson(0,'لا يوجد أي حساب مرتبط بهذا الرقم');
        }
    }


    public function newPassword(Request $request) {


        $rules = [
            'pin_code' => 'required',
            'new_password' => 'required|confirmed'
        ];


        $validator = validator()->make($request->all(), $rules);

        if($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        $client = Client::where('pin_code', $request->pin_code)->where('pin_code','!=', 0)->first();

        if($client) {

            $update = $client->update(['password' => $request->new_password, 'pin_code' => null]);


            if($update) {
                return responseJson(1, 'تم تغيير كلمة السر بنجاح');
            }
            else {
                return responseJson(0, 'حدث خطأ ، حاول مرة أخرى');
            } 

        }

        else {
            return responseJson(0, 'هذا الكود غير صالح');
        }

    }



     public function profile(Request $request) {

        $loginUser = $request->user();

        $rules = [
            'name'                =>   'min:3',
            'email'               =>  [
                                       'email',
                                        Rule::unique('clients')->ignore($loginUser->id)
                                    ],
            'date_of_birth'       =>  'date_format:Y-n-j|before:13 years ago',
            'blood_type_id'       =>  'integer|exists:blood_types,id',
            'last_donation_date'  =>  'date_format:Y-n-j|before_or_equal:today',
            'governorate_id'      =>  'integer|exists:governorates,id',
            'city_id'             =>  'integer|exists:cities,id',
            'phone'               => [
                                      'regex:/(01)[0-9]{9}/',
                                      'size:11',
                                      Rule::unique('clients')->ignore($loginUser->id)
                                    ], 
            'password'            =>  'confirmed'
        ];

        $validator = validator()->make($request->all(), $rules);

        if($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        $loginUser->update($request->all());

        /******* Add new bloodType and new Governorate to
                new notification settings when upateing any..
        ********/
        // if($request->has('blood_type_id')) {
        //     $loginUser->bloodTypes()->detach($loginUser->blood_type_id);    
        //     $loginUser->bloodTypes()->attach($loginUser->blood_type_id);    
        // }

        // if($request->has('city_id')) {
        //     $governorate = City::where('id', $loginUser->city_id)->first()->governorate;
        //     $loginUser->governorates()->detach($governorate->id);
        //     $loginUser->governorates()->attach($governorate->id);
        // }

        return responseJson(1, 'success', $loginUser);
    }


    public function registerNotificationToken(Request $request) {

        $rules = [
            'api_token' => 'required',
            'token'     => 'required',
            'platform'  => 'required|in:android,ios'
        ];

        $validator = validator()->make($request->all(), $rules);

       if($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        NotificationToken::where('token', $request->token)->delete();

        $request->user()->notificationTokens()->create($request->all());


        return responseJson(1,'تم إعداد الجهاز لاستقبال الإشعارات بنجاح');

    }


    public function removeNotificationToken(Request $request) {

        $rules = [
            'token' => 'required' 
        ];

        $validator = validator()->make($request->all(), $rules);

       if($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        NotificationToken::where('token', $request->token)->delete();

        return responseJson(1,'تم الحذف بنجاح');

    }










}

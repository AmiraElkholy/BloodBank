<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



use Illuminate\Validation\Rule;


//Model classes
use App\Models\Governorate;
use App\Models\City;
use App\Models\BloodType;
use App\Models\Post;
use App\Models\Category;
use App\Models\Setting;
use App\Models\ContactMessage;
use App\Models\Client;
use App\Models\donationRequest;
use App\Models\Notification;



class MainController extends Controller
{

    public function governorates() {
    	$governorates = Governorate::all();
    	return responseJson(1, 'success', $governorates);
    }


    public function cities(Request $requset) {

    	$cities = City::where(function($query) use($requset) {

    		if($requset->has('governorate_id')) {
    			$query->where('governorate_id', $requset->governorate_id);
    		}

    	})->paginate(20);
    	return responseJson(1, 'success', $cities);
    }


    
    public function bloodTypes() {
        $bloodTypes = BloodType::all();
        return responseJson(1, 'success', $bloodTypes);
    }


    public function posts(Request $request) {
        $posts = Post::with('category')->where(function($query) use($request) {
            if($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }
            if($request->has('keyword')) {
                $query->where('title', 'LIKE', '%'.$request->keyword.'%')
                      ->orWhere('body', 'LIKE', '%'.$request->keyword.'%');
            }
        })->paginate(10);

        return responseJson(1, 'success', $posts);
    }


    public function categories(Request $request) {
        $categories = Category::all();
        return responseJson(1, 'success', $categories);
    }


    public function post(Request $request) {
        $post = Post::find($request->post_id);
        return responseJson(1, 'success', $post);
    }


    public function toggleFavourites(Request $request) {

        $validator = validator()->make($request->all(), [
            'post_id' => 'required|exists:posts,id'
        ]);

        if($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $toggle = $request->user()->posts()->toggle($request->post_id);

        return responseJson(1, 'success', $toggle);
    }


    public function favourites(Request $request) {

        $favourites = $request->user()->posts()->latest()->paginate(20);

        return responseJson(1, 'تم تحميل المفضلة', $favourites);
    }


    public function settings() {
        $settings = Setting::all();
        return responseJson(1, 'success', $settings);
    }


    public function contactUS(Request $request) {

        $rules = [
            'phone'   =>  'required|regex:/(01)[0-9]{9}/|size:11' ,
            'name'    =>  'required|min:3' ,
            'subject' =>  'required|min:3' ,
            'body'    =>  'required|min:10'
        ];

        $validator = validator()->make($request->all(), $rules);

        if($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $contact_message = ContactMessage::create($request->all());

        return responseJson(1, 'تم إرسال رسالتك بنجاح', $contact_message);

    }



    public function notificationSettings(Request $request) {

        $rules = [
            'governorates'    => 'exists:governorates,id|array', 
            'blood_types'     => 'exists:blood_types,id|array'
        ];

        $validator = validator()->make($request->all(), $rules);

        if($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        $loginUser = $request->user();

        if($request->has('governorates')) {
            $loginUser->governorates()->sync($request->governorates);
        }

        if($request->has('blood_types')) {
            $loginUser->bloodTypes()->sync($request->blood_types);
        }


         $data = [
            'governorates' => $loginUser->governorates()->pluck('governorates.id')->toArray(),
            'blood_types'  => $loginUser->bloodTypes()->pluck('blood_types.id')->toArray(),
        ];

        return responseJson(1, 'تم التحديث', $data);

    }

    

    public function createDonationRequest(Request $request) {

        $rules = [
            'patient_name'         =>  'required|min:3',
            'patient_age'          =>  'required|digits:2',
            'blood_type_id'        =>  'required|integer|exists:blood_types,id',
            'number_of_bags'       =>  'required|numeric',
            'hospital_name'        =>  'required',
            'hospital_address'     =>  'required',
            'patient_phone'        =>  'required|regex:/(01)[0-9]{9}/|size:11',          
            'city_id'              =>  'required|integer|exists:cities,id',          
            'latitude'             =>  'required|numeric',          
            'longitude'            =>  'required|numeric',                    
            'api_token'            =>  'required'                    
        ];

        $validator = validator()->make($request->all(), $rules);

        if($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        //create donation request..
        $donationRequest = $request->user()->donationRequests()->create($request->all());



        //send notifications to suitable donors 
        $donorIds = $donationRequest->city->governorate->clients()
            ->whereHas('bloodTypes', function($query) use($request, $donationRequest) {
                    $query->where('blood_types.id', $donationRequest->blood_type_id);
            })->pluck('clients.id')->toArray();



        if(count($donorIds)) {

            $notification = $donationRequest->notification->create([
                'title'     =>  'أحتاج متبرع لفصيلة',
                'content'   =>  $donationRequest->BloodType->name.'محتاج متبرع بفصيلة'
            ]);


            $notification->clients()->attach($donorIds);


            //get tokens for FCM (Push Notification using Firebase cloud)
            
        }



        return responseJson(1,'',$donorIds);



    }





}

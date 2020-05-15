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
use App\Models\DonationRequest;
use App\Models\Notification;
use App\Models\NotificationToken;



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



        /* *** send notifications to suitable donors *** */
        //donors subscribed to the ame Governorate as the donation request    
        $donorIds1 = $donationRequest->city->governorate->clients()->pluck('clients.id')->toArray();
        //donors subscribed to the ame BloodType as the donation request    
        $donorIds2 = $donationRequest->bloodType->subscriberClients()->pluck('clients.id')->toArray(); 

        $donorIds = array_unique(array_merge($donorIds1, $donorIds2), SORT_REGULAR);

        if(count($donorIds)) {
           
            $notification = $donationRequest->notification()->create([
                'title'     =>  'توجد حالة جديدة محتاجة للتبرع بالدم',
                'content'   =>  $donationRequest->BloodType->name.' تحتاج متبرع بفصيلة'
            ]);


            //attach clients to this notification
            $notification->clients()->attach($donorIds);

            //get tokens for FCM (Push Notification using Firebase cloud)
            $tokens = NotificationToken::whereIn('client_id', $donorIds)->where('token', '!=', null)->pluck('token')->toArray();


            //dd($tokens);

            if(count($tokens)) {

                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'donation_request_id' => $donationRequest->id
                ];


                $send = notifiyByFireBase($title, $body, $tokens, $data);

                // info("firebase result: ".$send);
                // info("data: ".json_encode(data));

            }       
        }

        return responseJson(1, 'تمت إضفة ططل تبرع جديد بنجاح',  $donationRequest);
    }


    public function donationRequests(Request $request) {

        $donationRequests = DonationRequest::where(function($query) use($request) {
            if($request->has('blood_type_id')&$request->blood_type_id!='') {
                $query->where('blood_type_id', $request->blood_type_id);
            }
            if($request->has('governorate_id')&$request->governorate_id!='') {
                $citiesIds = Governorate::find($request->governorate_id)->cities()->pluck('id')->toArray();
                $query->whereIn('city_id', $citiesIds);
            }
        })->paginate(10);

        return responseJson(1, 'success', $donationRequests);
    }

    public function donationRequestDetails(Request $request) {
        $validator = validator()->make($request->all(), ['donation_request_id' => 'integer|exists:donation_requests,id']);
        if($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $donationRequest = donationRequest::find($request->donation_request_id);
        return responseJson(1, 'success', $donationRequest);        
    }



    public function notifications(Request $request) {

        $notifications = $request->user()->notifications()
                         ->with('donationRequest')->get();
        return responseJson(1, 'success', $notifications);
    }


}

<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Governorate;
use App\Models\ContactMessage;


use Auth;
use Carbon\Carbon;
use Hash;


class MainController extends Controller
{


	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:client-web', ['except' => ['about','contact','contactUs']]);
    }


    
	public function home(Request $request) {
		
		// dd($request->user());
		$posts = Post::where('publish_date','<=', Carbon::now()->toDateString())->latest()->limit(6)->get();
		$cities = City::all();
		return view('front.home', compact('posts', 'cities'));
	}


	public function toggleFavourites(Request $request) {
		$toggle = $request->user()->posts()->toggle($request->post_id);
        return responseJson(1, 'success', $toggle);
	}


	public function profile() {
		$user = Auth::guard('client-web')->user();
		return view('front.profile', compact('user'));
	}


	public function editProfile() {
		$blood_types = BloodType::all();
		$governorates = Governorate::all();
		$user = Auth::guard('client-web')->user();
		return view('front.edit-profile', compact('user', 'blood_types', 'governorates'));
	}


	public function updateProfile(Request $request) {
		//Y-n-j date format example:  1991-1-1
    	//Y-m-d date format example:  1991-01-01
    	// dd($request->all());
    	$rules = [
    		'name' 				  =>  'required|min:3|max:100',
    		'email' 			  =>  'required|email|unique:clients,email,'.$request->user()->id,
    		'date_of_birth' 	  =>  'required|date_format:Y-n-j|before:13 years ago',
    		'blood_type_id' 	  =>  'required|integer|exists:blood_types,id',
    		'last_donation_date'  =>  'required|date_format:Y-n-j|before_or_equal:today',
    		'city_id' 			  =>  'required|integer|exists:cities,id',
    		'phone' 			  =>  'required|regex:/(01)[0-9]{9}/|size:11|unique:clients,phone,'.$request->user()->id,
    		'password' 			  =>  'required|confirmed|min:6',
    		//only to populate cities in web version of register form
    		'governorate_id' 	  =>  'required|integer|exists:governorates,id',
    	];

    	$this->validate($request, $rules);


    	//check if client typed password correctly if not redirect them to the same form page with error

    	if(Hash::check($request->password, $request->user()->password)) {
    		$client = $request->user('client-web');
    		$client->update($request->all());

    		flash()->success('تم تعديل معلوماتك بنجاح');

    		return redirect()->route('profile');
    	}

    	flash()->error('خطأ بكلمة المرور ، لا تطابق بيانتنا.');

    	return view('front.edit-profile', ['user' => Auth::guard('client-web')->user(), 'blood_types' => BloodType::all(), 'governorates' => Governorate::all()]);
	}



    public function about() {
        return view('front.about');
    }



    public function contact() {
        return view('front.contact');    
    }


    public function contactUs(Request $request) {
         $rules = [
            'phone'   =>  'required|regex:/(01)[0-9]{9}/|size:11' ,
            'name'    =>  'required|min:3' ,
            'email'   =>  'required|email',
            'subject' =>  'required|min:3',
            'body'    =>  'required|min:10',
        ];

        $this->validate($request, $rules);


        $contactMsg = ContactMessage::create($request->all());

        if(!$contactMsg) {

            flash()->error('Something went wrong, your message was not sent. Please try again!');

            return redirect()->back()->withInput($request->all());
        }   
        
        flash()->success('Your message has been sent successfully. Thank you for contacting us :)');

        return redirect(url('/contact'));

    }


}

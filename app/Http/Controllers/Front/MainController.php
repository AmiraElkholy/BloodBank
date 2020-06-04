<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;


use Carbon\Carbon;


class MainController extends Controller
{


	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:client-web');
    }


    
	public function home(Request $request) {

		// $client = Client::first();
		// auth('client-web')->login($client);

		// dd($request->user('client-web'));

		$posts = Post::where('publish_date','<', Carbon::now()->toDateString())->latest()->limit(3)->get();
		$blood_types = BloodType::all();
		$cities = City::all();
		return view('front.home', compact('posts', 'blood_types', 'cities'));
	}


	public function about() {
		return view('front.about');
	}


}

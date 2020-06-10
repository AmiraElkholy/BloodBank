<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }



    public function logout() {
        Auth::guard('web')->logout();
        return redirect(route('adminHome'));
    }


}

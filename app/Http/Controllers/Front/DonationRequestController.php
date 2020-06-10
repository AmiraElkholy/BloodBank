<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Governorate;
use App\Models\City;
use App\Models\DonationRequest;



class DonationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // if ($request->isMethod('post')) {
        //     dd($request->all());
        // }

        $cities = City::all();

        $donation_requests = DonationRequest::where(function ($query) use($request){
            if ($request->input('city_id'))
            {
                $query->where(function ($query) use($request){
                    $query->where('city_id', '=', $request->city_id);
                });
            }

            if ($request->input('blood_type_id'))
            {
                $query->where('blood_type_id',$request->blood_type_id);
            }
        })->paginate(20);

        return view('front.donation-requests.index', compact('cities', 'donation_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('front.donation-requests.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'patient_name'         =>  'required|min:3',
            'patient_age'          =>  'required|digits:2',
            'blood_type_id'        =>  'required|integer|exists:blood_types,id',
            'number_of_bags'       =>  'required|numeric',
            'hospital_name'        =>  'required',
            'hospital_address'     =>  'required',
            'patient_phone'        =>  'required|regex:/(01)[0-9]{9}/|size:11',          
            'city_id'              =>  'required|integer|exists:cities,id',          
            // 'latitude'             =>  'required|numeric',          
            // 'longitude'            =>  'required|numeric',                                       
        ];

        $this->validate($request, $rules);

        $request->merge(['client_id' => $request->user('client-web')->id]);

        $donationRequest = DonationRequest::create($request->all());

        if(!$donationRequest) {

            flash()->error('Something went wrong, new donation request was not created. Please try again!');

            return redirect()->back()->withInput($request->all());
        }

        flash()->success('Your donation request has been created  successfully.');

        return redirect(url('/donation-requests/'.$donationRequest->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation_request = DonationRequest::findOrFail($id);
        return view('front.donation-requests.show', compact('donation_request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

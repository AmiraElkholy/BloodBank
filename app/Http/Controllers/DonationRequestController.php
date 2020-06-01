<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DonationRequest;
use App\Models\Notification;
use App\Models\Clientable;

use DB;


class DonationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = DonationRequest::all();
        return view('donation-requests.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = DonationRequest::findOrFail($id);
        return view('donation-requests.show', ['record' => $record]);
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
        $record = DonationRequest::findOrFail($id);

        //delete all notifications related to this donation request 
        //from both 'notifcations' and 'clientable' tables

        try {        
            DB::beginTransaction();

            //1. delete related notifications from 'clientable' table
            $notifications = Clientable::where('clientable_id', $record->notification->id)->where('clientable_type', 'App\Models\Notification')->delete();

            //2. delete notification from 'notifications' table
            $record->notification()->delete();


            //3. delete donation request itself fom 'donation_requests' table
            $record->delete();

            DB::commit();
        } catch (\PDOException $e) {
            // fail          
            DB::rollBack();
            
            flash()->error('Something went wrong, donation request wasn\'t not deleted.)');

            return redirect(route('donation-request.index'));
        }



        flash()->warning('Donation request has been successfully deleted.');
        return redirect(route('donation-request.index'));
    }
}

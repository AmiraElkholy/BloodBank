<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Clientable;
use App\Models\NotificationToken;

use DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Client::all();
        return view('clients.index', ['records' => $records]);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Client::findOrFail($id);
        return view('clients.show', ['record' => $record]);
    }

    
    public function toggleActivation($id)
    {
        $client = Client::findOrFail($id);
        $client->is_activated = !($client->is_activated);
        $client->update();
        flash()->success('Client is activated/de-activated successfully!');
        return redirect(route('clients.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Client::findOrFail($id);
        //can't delete if client has added donation requests
        if($record->donationRequests()->count()) {
            flash()->error("Client can't be deleted, there are related donation requests!");
            return redirect(route('clients.index'));
        }
        else {
           //Client can be deleted / start transaction
            try {        
                DB::beginTransaction();
                //1. delete favourite posts from 'clientable' table
                //2. delete bloodTypes client has subscribed to get notifications about from 'clientable' table
                //3. delete governorates client has subscribed to get notifications about from 'clientable' table
                //4. delete notifications from 'clientable' table
                Clientable::where('client_id', $record->id)->delete();
                //5. delete notificationTokens from 'notificationTokens' table
                NotificationToken::where('client_id', $record->id)->delete();
               
                //6. delete client from 'clients' table
                $record->delete();

                DB::commit();
            } catch (\PDOException $e) {
                // fail          
                DB::rollBack();
                
                flash()->error('Something went wrong, client wasn\'t not deleted.)');

                return redirect(route('donation-request.index'));
            }
        }

        flash()->warning('Client has been successfully deleted.');
        return redirect(route('clients.index'));    
    }


}

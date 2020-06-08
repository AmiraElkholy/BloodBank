<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use DB;
use Hash;

class UserController extends Controller
{
    
    public function editPassword() {
        return view('users.reset-password');
    }


    public function updatePassword(Request $request) {
        // dd($request->all());
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ];

        $messages = [
            'old_password.required' => 'Old Password is required.',
            'new_password.required' => 'New Password is required.', 
            'new_password.confirmed' => 'New Password and New Password Confirmation fileds must match.'
        ];

        $this->validate($request, $rules, $messages);

        if(Hash::check($request->old_password, auth()->user()->password)) {

            $currentUser = User::find(auth()->user()->id);

            $currentUser->update(['password' => $request->new_password]);

            flash()->success('Password has been successfully updated.');

            return back();
        }

        flash()->error('Old password credential does not match our records.');

        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = User::all();
        return view('users.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'roles_list' => 'required|array'
        ];
    
         $messages = [
            'roles_list.required' => 'Roles are required.'
        ];
   
        $this->validate($request, $rules, $messages);

        try {        
            DB::beginTransaction();
            
            $record = User::create($request->all());
            
            $record->roles()->attach($request->roles_list);

            DB::commit();

        } catch (\PDOException $e) {
            // fail          
            DB::rollBack();

            dd($e->getMessage());
            
            flash()->error('Something went wrong, user wasn\'t not added.)');

            return back();
        }

        flash()->success('New user has been saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = User::findOrFail($id);
        return view('users.show', ['record' => $record]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = User::findOrFail($id);
        return view('users.edit', ['record' => $record]);
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
        // dd($request->all());

        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'required|confirmed|min:8',
            'roles_list' => 'required|array'
        ];
    
         $messages = [
            'roles_list.required' => 'Roles are required.'
        ];
   
        $this->validate($request, $rules, $messages);
       
        $record = User::findOrFail($id);


        try {
            DB::beginTransaction();            

            $record->update($request->all());

            $record->roles()->sync($request->roles_list);

            DB::commit();
        
        } catch (\PDOException $e) {
            //fail
            DB::rollBack();

            dd($e->getMessage());

            flash()->error('Something went wrong, user was not updated.');

            return back();
        }

        flash()->success('User is updated successfully');

        return redirect(route('users.index'));

        //return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $record = User::findOrFail($id);
        
        try {

            DB::beginTransaction();

            $record->roles()->detach();

            $record->delete();

            DB::commit();

        } catch (\PDOException $e) {
            //fail
            DB::rollBack();
                    
            flash()->error("Something went wrong, user wasn't deleted.");
        
            return redirect(route('user.index'));   
        }

        flash()->warning('User has been successfully deleted.');
        
        return redirect(route('users.index'));    
    }
}

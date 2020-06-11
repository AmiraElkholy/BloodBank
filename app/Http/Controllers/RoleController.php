<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;

use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Role::all();
        return view('roles.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'permissions_list' => 'required|array'
        ];

        $messages = [
            'display_name.required' => 'Display Name is required.',
            'permissions_list.required' => 'Permissions are required.'
        ];
   
        $this->validate($request, $rules, $messages);

        try {        
            DB::beginTransaction();
            
            $record = Role::create($request->all());
            $record->permissions()->attach($request->permissions_list);

            DB::commit();

        } catch (\PDOException $e) {
            // fail          
            DB::rollBack();
            
            flash()->error('Something went wrong, role wasn\'t not added.)');

            return back();
        }

        flash()->success('New role has been saved successfully.');

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Role::findOrFail($id);
        return view('roles.show', ['record' => $record]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Role::findOrFail($id);
        return view('roles.edit', ['record' => $record]);
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
        $rules = [
            'name' => 'required|unique:roles,name,'.$id,
            'display_name' => 'required',
            'permissions_list' => 'required|array'
        ];

        $messages = [
            'display_name.required' => 'Display Name is required.',
            'permissions_list.required' => 'Permissions are required.'
        ];
   
        $this->validate($request, $rules, $messages);

        $record = Role::findOrFail($id);

        try {
            DB::beginTransaction();

            $record->update($request->all());

            // $record->permissions()->detach();

            $record->permissions()->sync($request->permissions_list);

            DB::commit();
        
        } catch (\PDOException $e) {
            //fail
            DB::rollBack();

            flash()->error('Something went wrong, role was not updated.');

            return back();
        }

        flash()->success('Role is updated successfully');

        return redirect(route('roles.index'));

        // return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $record = Role::findOrFail($id);
        
        try {

            DB::beginTransaction();

            $record->permissions()->detach();

            $record->delete();

            DB::commit();

        } catch (\PDOException $e) {
            //fail
            DB::rollBack();
                    
            flash()->error("Something went wrong, role wasn't deleted.");
        
            return redirect(route('role.index'));   
        }

        flash()->warning('Role has been successfully deleted.');
        
        return redirect(route('roles.index'));    
    }
}

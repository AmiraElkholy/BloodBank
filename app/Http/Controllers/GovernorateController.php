<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Governorate;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $governorates = Governorate::all();
        return view('governorates.index', ['governorates' => $governorates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('governorates.create');
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
            'name' => 'required|min:2|unique:governorates,name'
        ];
        $messages = [
            'name.required' => 'Name is required',
            'name.unique'   => 'The governorate has already been added'
        ];
        $this->validate($request, $rules, $messages);

        $governorate = Governorate::create($request->all());

        flash()->success('New governorate is saved successfully.');

        return redirect(route('governorates.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $governorate = Governorate::findOrFail($id);
        return view('governorates.show', ['governorate' => $governorate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $governorate = Governorate::findOrFail($id);
        return view('governorates.edit', ['governorate' => $governorate]);
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
            'name' => 'required|min:2|unique:governorates,name,'.$id
        ];

        $this->validate($request, $rules);

        $governorate = Governorate::findOrFail($id);

        $governorate->update($request->all());

        flash()->success('Governorate is updated successfully');

        return redirect(route('governorates.index'));

        // return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $governorate = Governorate::findOrFail($id);
        if($governorate->cities()->count()) {
            flash()->error("Governorate can't be deleted. There are related cities.");
        }
        else {
            $governorate->delete();
            flash()->warning('Governorate deleted successfully.');
        }
        return redirect(route('governorates.index'));
    }
}

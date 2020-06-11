<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\City;
use App\Models\Governorate;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('cities.index', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates = Governorate::all();
        $selectGovernorates = array();

        foreach($governorates as $governorate) {
            $selectGovernorates[$governorate->id] = $governorate->name;
        }

        return view('cities.create', ['availableGovernorates' => $selectGovernorates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [
            'name' => 'required|min:2|unique:cities,name',
            'governorate_id' => 'required|integer|exists:governorates,id'
        ];

        $this->validate($request, $rules);

        $city = City::create($request->all());

        flash()->success('New city is saved successfully.');

        return redirect(route('cities.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::findOrFail($id);
        return view('cities.show', ['city' => $city]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $governorates = Governorate::all();
        $selectGovernorates = array();

        foreach($governorates as $governorate) {
            $selectGovernorates[$governorate->id] = $governorate->name;
        }

        $city = City::findOrFail($id);
        return view('cities.edit', ['city' => $city, 'availableGovernorates' => $selectGovernorates]);
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
            'name' => 'required|min:2|unique:cities,name,'.$id,
            'governorate_id' => 'required|integer|exists:governorates,id'
        ];

        $this->validate($request, $rules);

        $city = City::findOrFail($id);

        $city->update($request->all());

        flash()->success('City is updated successfully');

        return back();
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
        $city = City::findOrFail($id);
         if($city->donationRequests()->count()) {
            flash()->error("City can't be deleted. There are related donation requests.");
        }
        else {
            $city->delete();
            flash()->warning('City deleted successfully.');
        }        
        return redirect(route('cities.index'));
    }
}

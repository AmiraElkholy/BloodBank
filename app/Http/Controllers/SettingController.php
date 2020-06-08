<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Setting::all();
        return view('settings.index', ['records' => $records]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Setting::findOrFail($id);
        return view('settings.edit', ['record' => $record]);
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
            'notification_settings_text' => 'required|min:10',
            'about_app_text' => 'required|min:10',
            'about_app_text_2' => 'required|min:10',
            'about_app_text_3' => 'required|min:10',
            'phone' => 'required|regex:/(01)[0-9]{9}/|size:11',
            'email' => 'required|email',
            'fb_link' => 'required|url',
            'tw_link' => 'required|url',
            'insta_link' => 'required|url',
            'youtube_link' => 'required|url',
            'whats_number' => 'required|regex:/[0-9 ]+/',
            'whats_link' => 'required|url',
            'intro_text' => 'required|min:10',
            'mobile_app_text' => 'required|min:10',
            'g_play_link' => 'required|url',
            'apple_store_link' => 'required|url',
            'about_us_text' => 'required|min:10',
            'fax_number' => 'regex:/[0-9 ]+/',
            'footer_text' => 'required|min:10',
        ];

        $this->validate($request, $rules);

        $record = Setting::findOrFail($id);

        $record->update($request->all());

        flash()->success('Settings have been updated successfully');

        return redirect(route('settings.index'));
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

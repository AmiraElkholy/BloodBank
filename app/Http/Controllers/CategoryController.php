<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Category::all();
        return view('categories.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'name' => 'required|min:3|unique:categories,name'
        ];
        $messages = [
            'name.required' => 'Name is required',
            'name.unique'   => 'The category has already been added'
        ];
        $this->validate($request, $rules, $messages);

        $category = Category::create($request->all());

        flash()->success('New category is saved successfully.');

        return redirect(route('category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Category::findOrFail($id);
        return view('categories.show', ['record' => $record]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Category::findOrFail($id);
        return view('categories.edit', ['record' => $record]);
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
            'name' => 'required|min:3'        
        ];

        $this->validate($request, $rules);

        $record = Category::findOrFail($id);

        $record->update($request->all());

        flash()->success('Category is updated successfully');

        return redirect(route('category.index'));

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
        $record = Category::findOrFail($id);
        if($record->posts()->count()) {
            flash()->error("Category can't be deleted. There are related posts.");
        }
        else {
            $record->delete();
            flash()->warning('Category deleted successfully.');
        }
        return redirect(route('category.index'));    }
}

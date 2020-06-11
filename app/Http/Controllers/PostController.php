<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Post::all();
        return view('posts.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $selectCategories = array();

        foreach($categories as $category) {
            $selectCategories[$category->id] = $category->name;
        }

        return view('posts.create', ['availableCategories' => $selectCategories]);
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
            'title' => 'required|min:2|unique:posts,title',
            'body'  => 'required|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|integer|exists:categories,id',
            'publish_date' => 'required'
        ];

        $this->validate($request, $rules);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        // dd($imageName);

        $requestData = $request->all();
        $requestData['image'] = $imageName;


        $record = Post::create($requestData);

        flash()->success('New post is saved successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Post::findOrFail($id);
        return view('posts.show', ['record' => $record]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Post::findOrFail($id);
     
        $categories = Category::all();
        $selectCategories = array();

        foreach($categories as $category) {
            $selectCategories[$category->id] = $category->name;
        }

        return view('posts.edit', ['record' => $record, 'availableCategories' => $selectCategories]);
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
            'title' => 'required|min:3|unique:posts,title,'.$id,
            'body'  => 'required|min:10',
            'category_id' => 'required|integer|exists:categories,id',
            'publish_date' => 'required'
        ];

        $this->validate($request, $rules);


        if($request->image) {

            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);

            // dd($imageName);

            $requestData = $request->all();
            $requestData['image'] = $imageName;

            $record = Post::findOrFail($id);

            $record->update($requestData);
        }
        
        else {

            $record = Post::findOrFail($id);

            $requestData = $request->all();
            $requestData['image'] = $record->image;


            $record->update($requestData);
        }

        
        flash()->success('Post is updated successfully');

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
        $record = Post::findOrFail($id);
        $record->delete();
        flash()->warning('Post has been successfully deleted.');
        return redirect(route('posts.index'));    
    }
}

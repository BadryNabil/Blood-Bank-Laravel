<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $records=Post::paginate(20);
     return view('posts.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('posts.create');
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

            'title'        => 'required',
            'body'         => 'required',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'category_id'  => 'required',
            'publish_date' => 'required',

        ];
        $messages = [
            'title.required'           => 'Title is required',
            'body.required'            => 'Body is required',
            'image.required'           => 'Image is required',
            'category_id.required'     => 'Category Id is required',
            'publish_date.required'    => 'Publish Date is required',
         ];

        $this->validate($request,$rules,$messages);
        $post=Post::create($request->all());
        if ($request->hasFile('image'))
            {
            $image = $request->file('image');
            $destinationPath = public_path().'/uploads/posts/images/';
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $name = time().''.rand(11111,99999).'.'.$extension; // renameing image
            $image->move($destinationPath, $name); // uploading file to given
            $post->image = 'uploads/posts/images/'.$name;
            $post->save();
          }

        flash()->success('success');
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
      $model=Post::findOrFail($id);
      return view('posts.edit',compact('model'));
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
      $record = Post::findOrFail($id);
      $record->update($request->all());
      flash()->success("Edited");
      return redirect(route('posts.index',$record->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
       {
           $record = Post::findOrFail($id);
           $record->delete();
           flash()->success("Deleted");
           return back();
        }



}

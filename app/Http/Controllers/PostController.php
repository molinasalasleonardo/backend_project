<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data ['posts'] = Post::paginate(5);
        return view("post.index",$data);
    }
    public function search(Request $request)
    {
        $data= $request -> input('search');
        $query = Post::select()
           ->where('title','like',"%$data%")
          ->orwhere('author','like',"%$data%")
          ->get();

        return view("post.index")->with(["posts" => $query]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // $data = $request->all();
        $data=$request->except('_token');
        if($request -> hasFile('image')){
            $data ['image'] = $request->file('image')->store('uploads', 'public');
        }
        Post::insert($data);
        return redirect()->route("post.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("post.show",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Post::findOrfail($id);
        return view ("post.edit") -> with(["post" => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // $data = $request->all();
        $data=$request->except('_token', '_method');
        if($request ->hasFile('image')){
            $post = Post::findOrfail($id);
            Storage::delete("public/$post->image");
            $data ['image'] = $request->file('image')->store('uploads', 'public');
        }
        Post::where('id','=',$id)->update($data);
        return redirect()->route("post.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route("post.index");
    }
}

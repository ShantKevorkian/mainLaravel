<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
//    public function __construct()
//    {
//
//        $this->middleware('auth');
//    }

    public function index()
    {
        $user = auth()->user();
        return view("posts")->with('posts', Post::where('user_id', $user->id)->get());
    }

//    public function create ()
//    {
//        return view("")
//    }
//
    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jfif,jpg,gif|max:2048',
            'title' =>'required|string|max:255',
            'description' =>'required|string'
        ]);
        $path = $request->file('image')->store('postImages', 'public');

        Post::where('id', $request->id)->update(
            ['original_name' => $request->image->getClientOriginalName(),
                'user_id' => $user->id,
                'path' => $path,
                'title' => $request->title,
                'description' => $request->description]);

        return redirect()->route("post.index",$path);
    }
//
//    public function delete ()
//    {
//
//    }


}

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

    public function index ()
    {
        $user =auth()->user();
        return view("posts") ->with('posts', Post::where('user_id' ,$user->id)->get());
    }

//    public function create ()
//    {
//        return view("")
//    }
//
    public function update ($id)
    {
        $user =auth()->user();
        return view("editPost")->with('posts', Post::where('user_id' ,$user->id)->first($id));
    }
//
//    public function delete ()
//    {
//
//    }


}

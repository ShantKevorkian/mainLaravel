<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostProfession;
use App\Models\Profession;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
//        $user = auth()->user();
//        $userProfessions = $user->professions->pluck("id");
//
//        $postsId = Post::whereHas('professions',function (Builder $query){
//            $query->where('id','$userProfessions');
//        });
//        dd($postsId);
////        $allPostsWhereProf = P

        return view('feed');
    }
}

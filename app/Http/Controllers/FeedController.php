<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostProfession;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Posts where post's professions id  equal to user professions id
        $posts = Post::whereHas('professions',function (Builder $query)
        {
            $userProfessions =  auth()->user()->professions->pluck("id");
            $query->whereIn('profession_id',$userProfessions);
        })->simplePaginate(3);


        return view('feed')
            ->with('posts',$posts)
            ->with('userPosts', Post::where('user_id', auth()->user()->id)->get()->load(['professions'])->pluck('id')->all());
    }
}

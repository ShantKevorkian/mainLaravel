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
        $userProfessions = auth()->user()->professions->pluck('id');

        $posts = Post::whereHas('professions', function (Builder $query) use ($userProfessions) {
            $query->whereIn('profession_id', $userProfessions);
        })
            ->where('user_id', '!=', auth()->id())
            ->simplePaginate(3);


        return view('feed')->with('posts', $posts);
    }
}

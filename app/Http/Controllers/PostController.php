<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostProfession;
use App\Models\Profession;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::with(['postImage', 'professions'])->where('user_id', auth()->id())->get();

        return view('posts.index')
            ->with('posts', $posts)
            ->with('professions', Profession::all());
    }

    public function create()
    {
        return view('posts.create')->with('professions', Profession::all());
    }

    public function edit(Post $post)
    {
        abort_if($post->user_id !==  auth()->id(), 403);

        return view('posts.edit')
            ->with('post', $post)
            ->with('professions', Profession::all());
    }

    public function show(Post $post)
    {
        return view('posts.show')
            ->with('post', $post->load('user.avatar', 'postImage'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jfif,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $path = $request->file('image')->store('postImages', 'public');

        $post = Post::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description]);

        $post->postImage()->create([
                'post_id' => $post->id,
                'original_name' => $request->image->getClientOriginalName(),
                'path' => $path,
            ]);

        $post->professions()->sync($request->profession);

        return redirect()->route('posts.index');
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jfif,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        if ($post->postImage()->exists()) {
            Storage::delete($post->postImage->path);
        }

        $path = $request->file('image')->store('postImages', 'public');

        $post->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        PostImage::updateOrCreate(
            ['post_id' => $post->id],
            [
                'original_name' => $request->image->getClientOriginalName(),
                'path' => $path,
            ]
        );

        $post->professions()->sync($request->professions);

        return redirect()->route('postss.index', $path);
    }

    public function destroy(Post $post)
    {
        if ($post->postImage()->exists())
        {
            Storage::delete($post->postImage()->path);
            $post->postImage()->delete();
        }

        $post->professions()->delete();
        $post->delete();

        return redirect()->route('posts.index');
    }
}

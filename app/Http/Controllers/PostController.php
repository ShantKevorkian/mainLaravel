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
        $user = auth()->user();
        return view("posts")
            ->with('posts', Post::where('user_id', $user->id)->get()->load(['postImage', 'professions']))
            ->with('professions', Profession::all());
    }

    public function create(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jfif,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);
        $user = auth()->user();

        Post::create([
                'user_id' => $user->id,
                'title' => $request->title,
                'description' => $request->description]);
        $postLastId = DB::table('posts')->where('user_id', $user->id)->orderBy('id', 'desc')->first()->id;
        $post = Post::where('id', $postLastId);
        $path = $request->file('image')->store('postImages', 'public');

        PostImage::create([
                'post_id' => DB::table('posts')->where('user_id', $user->id)->orderBy('id', 'desc')->first()->id,
                'original_name' => $request->image->getClientOriginalName(),
                'path' => $path,]);
        $post->where('user_id', $user->id)->first()->professions()->sync($request->profession);
        return redirect()->route("post.index");
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jfif,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);
        $user = auth()->user();
        $post = Post::where('id', $request->id);
        $image = PostImage::where("post_id", $request->id);

        if ($image->select("path")->first()) {
            Storage::delete($image->select("path")->first()->path);
        }

        $path = $request->file('image')->store('postImages', 'public');
        $post->update(
            [
                'user_id' => $user->id,
                'title' => $request->title,
                'description' => $request->description
            ]);
        //Here updateOrCreate for testing but in real must be Update,TODO
        PostImage::where('post_id', $request->id)->updateOrCreate(
            ['post_id' => $request->id],
            ['original_name' => $request->image->getClientOriginalName(),
                'path' => $path,]);
        $post->where('user_id', $user->id)->first()->professions()->sync($request->profession);
        return redirect()->route("post.index", $path);
    }

    public function delete(Request $request)
    {
        $image = PostImage::where("post_id", $request->id);
        //In real there no need for if because each post must have image TODO

        if ($image->select("path")->first())
        {
            Storage::delete($image->select("path")->first()->path);
        }

        $image->delete();
        PostProfession::where("post_id", $request->id)->delete();
        Post::where('id', $request->id)->delete();

        return redirect()->route('post.index');
    }

    public function postDetail(Post $post)
    {
        return view('postDetail')
            ->with('post',$post->load('user','postImage'))
            ->with("avatar",Avatar::where('user_id',$post->user_id)->first());
    }

    public function showUpdate(Post $post)
    {
        abort_if($post->user_id !==  auth()->id(), 403);
        return view('editPost')
            ->with('post', $post)
            ->with('professions', Profession::all());
    }

    public function showNewPost()
    {
        return view('createPost')
            ->with("professions", Profession::all());
    }

}

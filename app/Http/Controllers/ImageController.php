<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use MongoDB\Driver\Session;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store (Request $request){
        $userId = auth()->id();
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jfif,jpg,gif|max:2048',
        ]);

        if($avatar = Avatar::where('user_id',$userId)->select("path")->first()){
            Storage::delete($avatar->path);
        }

        $path = $request->file('avatar')->store('avatars','public');
        Avatar::updateOrCreate(

            ['user_id' => $userId],
            ['original_name' => $request->avatar->getClientOriginalName(),
                'path' => $path]
        );
           return back()->with('success','Image  uploaded');
    }
}

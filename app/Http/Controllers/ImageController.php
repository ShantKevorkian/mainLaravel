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


    public function upload (Request $request){
        $user = auth()->user();

        $path = $request->file('avatar')->store('avatars','public');
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        Avatar::updateOrCreate(
            ['user_id' => $user->id],
            ['original_name' => $request->avatar->getClientOriginalName(),
                'path' => $path]
        );




           return back()->with('success','Image  uploaded');

    }
}

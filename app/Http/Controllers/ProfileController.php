<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
            $this->middleware('auth');
    }





    public function index()
    {
        $user =User::with(['profession'])->find(Auth::id());
        $profArr =[];
        foreach ($user->profession as $profession){

            array_push($profArr ,$profession['id']);
        }


        return view('profile')
            ->with('user', User::with(['detail'])->find(Auth::id()))
            ->with('professions', Profession::all())
            ->with("user_professions",$profArr);

    }

    public function update(Request $request)
    {

            $request->validate([
                'name' => 'required|string|max:191',
                'email' => [
                    'required',
                    Rule::unique('users')->ignore(Auth::id())
                ],
                'password' => 'nullable|string',

            ]);
            User::where('id', Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : Auth::user()->password
            ]);


        return back()->with('successProf', 'Profile successfully updated');

    }

}


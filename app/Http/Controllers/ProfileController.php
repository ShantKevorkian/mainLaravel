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
        return view('profile')
            ->with('user', auth()->user()->load('detail','professions','avatar'))
            ->with('professions', Profession::all());
    }

    public function update(Request $request)
    {
        $user=auth()->user();
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'nullable|string',

        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password
        ]);
        return back()->with('successProf', 'Profile successfully updated');
    }
}


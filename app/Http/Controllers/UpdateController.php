<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'phone' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'city' => 'required|string|max:191',
            'country' => 'required|string|max:191',
            "professions" => 'nullable|array|',
            "professions.*"=>'exists:professions,id'

        ]);
        Detail::updateOrCreate(
            ['user_id' => $user->id],
            ['phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country]
        );
        $user->professions()->sync($request->profession);

        return back()->with('successDe', 'Details successfully updated');
    }




}

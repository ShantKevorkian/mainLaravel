<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\UserProfession;
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
        Detail::updateOrCreate(
            ['user_id' => Auth::id()],
            ['phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country]
        );




//        UserProfession::updateOrCreate(
//            ['user_id' => Auth::id()],
//            ['profession_id'=> $request->]
//        );


        return back()->with('successDe', 'Details successfully updated');
    }




}

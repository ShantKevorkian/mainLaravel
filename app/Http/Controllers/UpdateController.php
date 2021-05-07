<?php

namespace App\Http\Controllers;

use App\Models\Detail;
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
        Detail::where('user_id', Auth::id())->update([
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country
        ]);
        return back()->with('successDe', 'Details successfully updated');
    }




}

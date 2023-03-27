<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('pages.settings');
    }

    public function change_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with([
            'message'=>'Profile updated Succeesfully',
            'active_tab'=>'update_profile',
            'success'=>true
        ]);
    }

    public function change_password(Request $request)
    {
        $user = User::find(Auth::id());


        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'new_password' => 'required',
            'new_confirm_password' => 'required|same:new_password'
        ]);


        $user->password = Hash::make($request->new_password);
        $user->save();


        return redirect()->back()->with([
            'message'=>'Password updated Succeesfully',
            'active_tab'=>'change_password',
            'success'=>true
        ]);

    }

}

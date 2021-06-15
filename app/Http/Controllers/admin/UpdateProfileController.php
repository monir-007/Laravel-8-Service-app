<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateProfileController extends Controller
{
    public function changePassword()
    {
        return view('admin.profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|confirmed',

        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldPassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password Changed Successfully');
        }
        return redirect()->route('login')->with('success', 'Password is invalid');
    }

    public function updateProfile()
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            if ($user) {
                return view('admin.profile.update-profile', compact('user'));
            }
        }
    }

    public function updateProfileNew(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user){
            $user->name=$request['name'];
            $user->email=$request['email'];
            $user->save();
            return redirect()->back()->with('success','User information updated. ');
        }
        return redirect()->back();
    }
}
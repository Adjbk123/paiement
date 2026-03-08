<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.user.profile');
    }
    public function updateUserDetails(Request $request)
    {

        $request->validate([
            'username'=>['required' , 'string'],
            'phone'=>['required' , 'digits:10'],
            'pin_code'=>['required' , 'digits:6'],
            'address'=>['required' , 'string' , 'max:499'],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name'=>$request->username
        ]);
        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'phone'=>$request->phone,
                'pin_code'=>$request->pin_code,
                'address'=>$request->address,
            ]
        );
        return  redirect()->back()->with('message' , 'User Profil Updated successfully');

    }
    public function changepassword()
    {
        return view('frontend.user.change-passward');
    }
    public function changepasswords(Request $request)
    {
        $request->validate([
            'current_password'=>['required' , 'string' , 'min:8'],
            'password'=>['required'  , 'string' , 'min:8' , 'confirmed']
        ]);
        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if ($currentPasswordStatus){
            User::findOrFail(Auth::user()->id)->update([
                'password'=>Hash::make($request->password),
            ]);
            return redirect()->back()->with('message' , 'password Updated Successfully');
        }else{
            return redirect()->back()->with('message' , 'current password does not match with Old Password');
        }
    }
}

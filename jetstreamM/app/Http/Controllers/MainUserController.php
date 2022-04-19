<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class MainUserController extends Controller
{
    //
    public function Register(){
        return view('user.register');
    }

    public function Login(){
        return view('user.login');
    }

    public function UserProfile(){
        $id=Auth::user()->id;
        $user=User::find($id);
        return view('user.profile.view_profile', compact('user'));
    }

    public function UserProfileEdit(){
        $id=Auth::user()->id;
        $editData=User::find($id);
        return view('user.profile.view_profile_edit', compact('editData'));
    }

public function UserProfileUpdate(Request $request){
$data=User::find(Auth::user()->id);
$data->name=$request->name;
$data->email=$request->email;
if ($request->file('profile_photo_path')){
$file=$request->file('profile_photo_path');
@unlink(public_path('upload/user_images/'.$data->profile_photo_path));
$fileName=date('YmdHi').$file->getClientOriginalName();
$file->move(public_path('upload/user_images'), $fileName);
$data['profile_photo_path']=$fileName;

}
$data->save();

$notification= array(
    'message'=>'Profile Updated Successfully',
    'alert-type'=>'success'

);
return redirect()->route('user.profile')->with($notification);
    }

    public function Logout(){
        Auth::logout();
        return redirect()->route('user.login');
    }
}

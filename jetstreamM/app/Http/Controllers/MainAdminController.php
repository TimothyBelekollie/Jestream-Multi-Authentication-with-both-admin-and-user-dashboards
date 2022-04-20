<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class MainAdminController extends Controller
{
    public function AdminProfile(){
$adminData=Admin::find(1);
return view('admin.profile.view_profile',compact('adminData'));
    }
    public function AdminProfileEdit(){
        $editData=Admin::find(1);
        return view('admin.profile.edit_profile',compact('editData'));
    }
    public function AdminProfileStore(Request $request){
        $data=Admin::find(1);
        $data->name=$request->name;
        $data->email=$request->email;
        if ($request->file('profile_photo_path')){
        $file=$request->file('profile_photo_path');
        @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
        $fileName=date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload/admin_images'), $fileName);
        $data['profile_photo_path']=$fileName;

        }
        $data->save();

        $notification= array(
            'message'=>'Profile Updated Successfully',
            'alert-type'=>'success'

        );
        return redirect()->route('admin.profile')->with($notification);
    }
    public function AdminChangePassword(){
        // $id=Admin::find(1);

        // $adminpassword=Admin::find($id);
        return view('admin.password.view_password');
    }
    public function AdminChangePasswordUpdate(Request $request){
        $validateData=$request->validate([
            'oldpassword'=>'required',
            'password'=>'required|confirmed',

        ]);
        $hashedpassword=Admin::find(1)->password;
        if(Hash::check($request->oldpassword, $hashedpassword)){
            $admin=Admin::find(1);
            $admin->password=Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.login');
        }else{
            return redirect()->back();
        }
    }
}

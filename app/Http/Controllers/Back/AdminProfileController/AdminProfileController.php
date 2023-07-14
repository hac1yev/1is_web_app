<?php

namespace App\Http\Controllers\Back\AdminProfileController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminProfileController extends Controller
{
    public function adminProfilePassword(){
        return view('back.profile.password');
    }
    public function adminProfilePasswordPost(Request $request){
        $user = Auth::user();
        $request->validate([
            'current_pass'=>'required',
            'new_pass'=>'required|min:6',
            'new_pass_reply'=>'required|same:new_pass|min:6',
        ]);
        if ($request->current_pass) {
            if (Hash::check($request->current_pass, $user->password)) {
                $password = Hash::make($request->new_pass);
                $user->password = $password;
            }else {
                return redirect()->back()->with('error_pass', true);
            }
        }
        return redirect()->back()->with( $user->save() ? "success" : "error", true);
    }

    public function adminProfileIndex(){
        return view('back.profile.profile');
    }
    public function adminProfilePost(Request $request){
        $request->validate([
            'name'=>'required',
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024'
            ]);
            $image = $request->file('image');
            $name = 'admin'.'_' .Str::random(6).'.' . $image->getClientOriginalExtension();
            $old_image = $user->image;
            $directory = 'back/assets/images/users/';
            if (file_exists($old_image) && $old_image != 'back/assets/images/users/default-user.png') {
                unlink($old_image);
            }
            $image->move($directory, $name);
            $name = $directory.$name;
            $user->image = $name;
        }
        return redirect()->back()->with($user->save() ? 'success' : 'error',true);
    }
    public function adminList(){
        $admins = User::where([['is_admin','1'],['is_superadmin','0']])->get();
        return view('back.admins.list',compact('admins'));
    }
    public function adminListPost(Request $request){
        $request->validate([
           'name'=>'required',
           'email'=>'required|email|unique:users',
           'password'=>'required|min:6',
        ]);

        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->is_admin = '1';
        $admin->is_superadmin = '0';
        $admin->status = '1';

        return redirect()->back()->with($admin->save() ? 'success' : 'error',true);
    }
    public function adminListPassword(Request $request){
        $admin = User::where([['is_admin','1'],['is_superadmin','0'],['id',$request->id]])->first();
        if(!$admin){
            return '0';
        }
        $password = '123456';
        $admin->password = Hash::make($password);
        return $admin->save() ? '1' : '0';
    }
    public function adminListDelete(Request $request){
        $admin = User::where([['is_admin','1'],['is_superadmin','0'],['id',$request->id]])->first();
        if(!$admin){
            return '0';
        }
        $old_image = $admin->image;
        if (file_exists($old_image) && $old_image != 'back/assets/images/users/default-user.png') {
            unlink($old_image);
        }
        return $admin->delete() ? '1' : '0';
    }
}

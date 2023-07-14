<?php

namespace App\Http\Controllers\Back\LoginImageController;

use App\Http\Controllers\Controller;
use App\Models\LoginImages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginImageController extends Controller
{
    public function imageIndex(){
        $images = LoginImages::all();
        return view('back.login_image.list',compact('images'));
    }
    public function imagePost(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024'
        ]);
        $data = new LoginImages();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'login_'.Str::random(6).'.' . $image->getClientOriginalExtension();
            $directory = 'back/assets/images/login/';
            $image->move($directory, $name);
            $name = $directory.$name;
            $data->image = $name;
        }
        return redirect()->back()->with($data->save() ? 'success' : 'error',true);
    }
    public function imageStatus(Request $request){
        $data = LoginImages::find($request->id);
        if(!$data){
            return response()->json('0');
        }
        $data->status = $data->status == '0' ? '1' : '0';
        return $data->save() ? response()->json('1') : response()->json('0');
    }
    public function imageDelete(Request $request){
        $data = LoginImages::find($request->id);
        if(!$data){
            return response()->json('0');
        }
        $old_image = $data->image;
        if(file_exists($old_image)){
            unlink($old_image);
        }
        return $data->delete() ? response()->json('1') : response()->json('0');
    }
}

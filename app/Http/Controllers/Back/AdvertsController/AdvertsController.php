<?php

namespace App\Http\Controllers\Back\AdvertsController;

use App\Http\Controllers\Controller;
use App\Models\Adverts;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdvertsController extends Controller
{
    public function advertListIndex(){
        $ads = Adverts::all();
        return view('back.adverts.ads',compact('ads'));
    }
    public function advertListPost(Request $request){
        $request->validate([
           'redirect_link'=>'required',
           'image'=>'image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024',
        ]);

        $ads = new Adverts();
        $ads->redirect_link = $request->redirect_link;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'advert'.'_' .Str::random(6).'.' . $image->getClientOriginalExtension();
            $directory = 'back/assets/images/adverts/';
            $image->move($directory, $name);
            $name = $directory.$name;
            $ads->image = $name;
        }
        return redirect()->back()->with($ads->save() ? 'success' : 'error',true);
    }
    public function advertStatus(Request $request){
        $ads = Adverts::find($request->id);
        if(!$ads){
            return '0';
        }
        $ads->status = $ads->status == '1' ? '0' : '1';
        return $ads->save() ? '1' : '0';
    }
    public function advertDelete(Request $request){
        $ads = Adverts::find($request->id);
        if(!$ads){
            return '0';
        }
        return $ads->delete() ? '1' : '0';
    }
}

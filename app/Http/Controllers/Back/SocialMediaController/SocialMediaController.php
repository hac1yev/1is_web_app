<?php

namespace App\Http\Controllers\Back\SocialMediaController;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function settingsSocialIndex(){
        $social = SocialMedia::first();
        return view('back.settings.social',compact('social'));
    }
    public function settingsSocialPost(Request $request){
       $request->validate([
          'facebook'=>'required',
          'instagram'=>'required',
          'linkedin'=>'required',
       ]);
        $social = SocialMedia::first();
        $social->facebook = $request->facebook;
        $social->instagram = $request->instagram;
        $social->linkedin = $request->linkedin;
        return redirect()->back()->with($social->save() ? 'success' : 'error',true);
    }
}

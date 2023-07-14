<?php

namespace App\Http\Controllers\Back\BannerImageController;

use App\Http\Controllers\Controller;
use App\Models\BannerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerImageController extends Controller
{
    public function bannerImageIndex(){
        $banner = BannerImage::first();
        return view('back.banner.banner',compact('banner'));
    }
    public function bannerImagePost(Request $request){
        $banner = BannerImage::first();
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:5120'
            ]);
            $image = $request->file('image');
            $name = 'banner_' .Str::random(6).'.' . $image->getClientOriginalExtension();
            $old_image = $banner->image;
            $directory = 'back/assets/images/banner/';
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            $image->move($directory, $name);
            $name = $directory.$name;
            $banner->image = $name;

            return redirect()->back()->with($banner->save() ? ' success' : 'error',true);
        }
        return redirect()->back()->with('empty_logo',true);
    }
}

<?php

namespace App\Http\Controllers\Back\BlogController;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Settings;

class BlogController extends Controller
{
    public function blogListIndex(){
        $blogs = Blogs::orderBy('id','DESC')->get();
        return view('back.blog.list',compact('blogs'));
    }
    public function blogAddIndex(){
        return view('back.blog.add');
    }
    public function blogAddPost(Request $request)
{
    $languages = Language::all();
    $request->validate([
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024'
    ]);

    foreach ($languages as $language) {
        $request->validate([
            'title_' . $language->shortname => 'required',
            'content_' . $language->shortname => 'required',
            'keywords_' . $language->shortname => 'required',
        ]);
    }

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $name = 'post_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
        $directory = 'back/assets/images/posts/';
        $image->move($directory, $name);
        $name = $directory . $name;
    }

    $blog = new Blogs();
    $blog->user_id = Auth::user()->id;
    $slug = Str::slug($request->title_az);
    $old_blog = Blogs::where('slug', $slug)->first();
    if ($old_blog) {
        $slug = $slug . '_' . rand(1000, 9999);
    }
    $blog->slug = $slug;
    $blog->image = $name;

    // Anahtar kelimeleri birleştirme ve settings tablosuna eklemek
    foreach ($languages as $language) {
        $keywords = 'keywords_' . $language->shortname;
        $metaKeywords = 'meta_keywords_' . $language->shortname;

        $keywordsArray = json_decode($request->$keywords, true);
        $settings = Settings::firstOrCreate([]);

        if (!empty($keywordsArray)) {
            $existingMetaKeywords = json_decode($settings->$metaKeywords, true);
            $combinedKeywords = array_merge($existingMetaKeywords, $keywordsArray);
            $settings->$metaKeywords = json_encode($combinedKeywords);
        }

        $title = 'title_' . $language->shortname;
        $content = 'content_' . $language->shortname;
        $blog->$title = $request->$title;
        $blog->$content = $request->$content;

        $settings->save();
    }

    return redirect()->route('blogListIndex')->with($blog->save() ? 'success' : 'error', true);
}

    

    public function blogEditIndex($id){
        $blog = Blogs::find($id);

        if(!$blog){
            return redirect()->route('blogListIndex')->with('non_blog',true);
        }
        return view('back.blog.edit',compact('blog'));
    }
    public function blogEditPost(Request $request){
        $languages = Language::all();
        $request->validate([
            'view' => 'required|numeric'
        ]);
        foreach ($languages as $language){
            $request->validate([
                'title_'.$language->shortname => 'required',
                'content_'.$language->shortname => 'required',
                'keywords_'.$language->shortname => 'required',
            ]);
        }
        $blog = Blogs::find($request->id);
        if(!$blog){
            return redirect()->route('blogListIndex')->with('non_blog',true);
        }
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024'
            ]);
            $image = $request->file('image');
            $old_image = $blog->image;
            if(file_exists($old_image)){
                unlink($image);
            }
            $name = 'post_'.Str::random(6).'.' . $image->getClientOriginalExtension();
            $directory = 'back/assets/images/posts/';
            $image->move($directory, $name);
            $name = $directory.$name;
            $blog->image = $name;
        }
        $slug = Str::slug($request->title_az);
        $old_blog = Blogs::where('slug',$slug)->first();
        if($old_blog){
            $slug = $slug . '_' . rand(1000,9999);
        }
        $blog->slug = $slug;
        $blog->view = $request->view;
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;
            $content = 'content_'.$language->shortname;
            $keywords = 'keywords_'.$language->shortname;

            $blog->$title = $request->$title;
            $blog->$content = $request->$content;
            $blog->$keywords = $request->$keywords;
        }
        return redirect()->route('blogEditIndex',$request->id)->with($blog->save() ? 'success' : 'error',true);
    }
    public function blogStatusPost(Request $request){
        $blog = Blogs::find($request->id);
        if(!$blog){
            return '1';
        }
        $blog->status = $blog->status == '1' ? '0' : '1';
        return $blog->save() ? '1' : '0';
    }
    public function blogDeletePost(Request $request){
        $blog = Blogs::find($request->id);
        if(!$blog){
            return '1';
        }
        if(file_exists($blog->image)){
            unlink($blog->image);
        }
        return $blog->delete() ? '1' : '0';
    }
}

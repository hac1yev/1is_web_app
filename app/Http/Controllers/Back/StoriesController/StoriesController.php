<?php

namespace App\Http\Controllers\Back\StoriesController;

use App\Http\Controllers\Controller;
use App\Models\Stories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoriesController extends Controller
{
    public function storyIndex(){
        $stories = Stories::all();
        return view('back.story.list',compact('stories'));
    }
    public function storyPost(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024',
            'stories' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif',
            'link' => 'required|min:3',
        ]);
        $story = new Stories();
        $story->redirect_link = $request->link;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'story_'.Str::random(6).'.' . $image->getClientOriginalExtension();
            $directory = 'back/assets/images/stories/';
            $image->move($directory, $name);
            $name = $directory.$name;
            $story->image = $name;
        }
        if ($request->hasFile('stories')) {
            $stories = $request->file('stories');
            $name = 'story_'.Str::random(6).'.' . $stories->getClientOriginalExtension();
            $directory = 'back/assets/images/stories/';
            $stories->move($directory, $name);
            $name = $directory.$name;
            $story->stories = $name;
        }
        return redirect()->back()->with($story->save() ? 'success' : 'error',true);
    }
    public function storyEdit(Request $request){
        $story = Stories::find($request->id);
        return $story ?? response()->json('0');
    }
    public function storyEditPost(Request $request){
        $request->validate([
            'edit_link' => 'required|min:3',
        ]);
        $story = Stories::find($request->id);
        if(!$story){
            return redirect()->back()->with('error',true);
        }
        $story->redirect_link = $request->edit_link;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024',
            ]);
            $image = $request->file('image');
            $old_image = $story->image;
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $name = 'story_'.Str::random(6).'.' . $image->getClientOriginalExtension();
            $directory = 'back/assets/images/stories/';
            $image->move($directory, $name);
            $name = $directory.$name;
            $story->image = $name;
        }
        if ($request->hasFile('stories')) {
            $request->validate([
                'stories' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif',
            ]);
            $stories = $request->file('stories');
            $old_image = $story->stories;
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $name = 'story_'.Str::random(6).'.' . $stories->getClientOriginalExtension();
            $directory = 'back/assets/images/stories/';
            $stories->move($directory, $name);
            $name = $directory.$name;
            $story->stories = $name;
        }
        return redirect()->back()->with($story->save() ? 'success' : 'error',true);
    }
    public function storyStatus(Request $request){
        $story = Stories::find($request->id);
        if(!$story){
            return response()->json('0');
        }
        $story->status = $story->status == '0' ? '1' : '0';
        return $story->save() ? response()->json('1') : response()->json('0');
    }
    public function storyDelete(Request $request){
        $story = Stories::find($request->id);
        if(!$story){
            return response()->json('0');
        }
        $old_image = $story->image;
        if(file_exists($old_image)){
            unlink($old_image);
        }
        return $story->delete() ? response()->json('1') : response()->json('0');
    }
}

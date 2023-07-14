<?php

namespace App\Http\Controllers\Back\TrainingsController;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\Trainings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TrainingsController extends Controller
{
    public function trainingList(){
        $trainings = Trainings::orderBy('id','DESC')->get();
        return view('back.trainings.list',compact('trainings'));
    }
    public function trainingAdd(){
        $companies = Companies::where('status','1')->get();
        return view('back.trainings.add',compact('companies'));
    }
    public function trainingAddPost(Request $request){
        $request->validate([
            'company'=>'numeric',
            'payment_type'=>'numeric',
            'image'=>'image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:6000',
        ]);
        $training = new Trainings();
        $training->user_id = Auth::user()->id;
        $training->company_id = $request->company;
        $training->title = $request->title;
        $slug = Str::slug($request->title);
        if(Trainings::where('slug',$slug)->first()){
            $slug = $slug.rand(1000,9999);
        }
        $training->slug = $slug;
        $training->about = $request->about;
        $training->redirect_link = $request->link;
        $training->payment_type = $request->payment_type;
        if($request->payment_type != 0){
            $training->price = $request->price;
        }
        $training->deadline = $request->deadline;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'training_'.Str::random(6).'.'.$image->getClientOriginalExtension();
            $directory = 'back/assets/images/trainings/';
            $image->move($directory, $name);
            $name = $directory.$name;
            $training->image = $name;
        }
        return redirect()->route('trainingList')->with($training->save() ? 'success' : 'error',true);
    }
    public function trainingEdit($id){
        $training = Trainings::find($id);
        if(!$training){
            return redirect()->route('trainingList')->with('error',true);
        }
        $companies = Companies::where('status','1')->get();
        return view('back.trainings.edit',compact('training','companies'));
    }
    public function trainingEditPost(Request $request){
        $request->validate([
            'id'=>'required',
            'company'=>'required|numeric',
            'title'=>'required',
            'about'=>'required',
            'link'=>'required',
            'payment_type'=>'required|numeric',
            'deadline'=>'required',

        ]);
        $training = Trainings::find($request->id);
        if(!$training){
            return redirect()->route('trainingList')->with('error',true);
        }
        $training->company_id = $request->company;
        $training->title = $request->title;
        $slug = Str::slug($request->title);
        if(Trainings::where([['slug',$slug],['id','<>',$training->id]])->first()){
            $slug = $slug.rand(1000,9999);
        }
        $training->slug = $slug;
        $training->about = $request->about;
        $training->redirect_link = $request->link;
        $training->payment_type = $request->payment_type;
        if($request->payment_type != 0){
            $training->price = $request->price;
        }else{
            $training->price = NULL;
        }
        $training->deadline = $request->deadline;
        if ($request->hasFile('image')) {
            $request->validate([
                'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024',
            ]);
            $image = $request->file('image');
            $name = 'training_'.Str::random(6).'.'.$image->getClientOriginalExtension();
            $old_image = $training->image;
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $directory = 'back/assets/images/trainings/';
            $image->move($directory, $name);
            $name = $directory.$name;
            $training->image = $name;
        }
        return redirect()->route('trainingEdit',$training->id)->with($training->save() ? 'success' : 'error',true);
    }
    public function trainingStatus(Request $request){
        $training = Trainings::find($request->id);
        if(!$training){
            return response()->json(0);
        }
        $training->status = $training->status == '1' ? '0' : '1';
        return $training->save() ? response()->json(1) : response()->json(0);
    }
    public function trainingDelete(Request $request){
        $training = Trainings::find($request->id);
        if(!$training){
            return response()->json(0);
        }
        $old_image = $training->image;
        if(file_exists($old_image)){
            unlink($old_image);
        }
        return $training->delete() ? response()->json(1) : response()->json(0);
    }
}

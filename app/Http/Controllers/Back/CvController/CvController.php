<?php

namespace App\Http\Controllers\Back\CvController;

use App\Http\Controllers\Controller;
use App\Models\AcceptType;
use App\Models\Categories;
use App\Models\Cities;
use App\Models\Companies;
use App\Models\Cv;
use App\Models\Educations;
use App\Models\Experiences;
use App\Models\Gender;
use App\Models\JobType;
use App\Models\Regions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CvController extends Controller
{
    public function cvList(){
        $cvs = Cv::orderBy('id','DESC')->get();
        return view('back.cv.list',compact('cvs'));
    }
    public function cvAdd(){
        $categories = Categories::all();
        $cities = Cities::all();
        $regions = Regions::all();
        $jobtypes = JobType::all();
        $experiences = Experiences::all();
        $educations = Educations::all();
        $genders = Gender::all();
        return view('back.cv.add',compact('categories','cities','regions','jobtypes','experiences','educations','genders'));
    }
    public function cvStatus(Request $request){
        $cv = Cv::find($request->id);
        if(!$cv){
            return '0';
        }
        $cv->status = $cv->status == '0' ? '1' : '0';
        return $cv->save() ? '1' : '0';
    }
    public function cvDelete(Request $request){
        $cv = Cv::find($request->id);
        if(!$cv){
            return '0';
        }
        if(file_exists($cv->cv)){
            unlink($cv->cv);
        }
        if(file_exists($cv->image)){
            unlink($cv->image);
        }
        return $cv->delete() ? '1' : '0';
    }
    public function cvEdit($id){
        $cv=Cv::find($id);
        if(!$cv){
            return  redirect()->route('cvList')->with('error',true);
        }
        $cvlink = explode(".",$cv->cv);
        $path = asset($cv->cv);
        if($cvlink[1] != "pdf" && $cvlink[1] != "png" && $cvlink[1] != "jpg"){
            $cv_path="https://view.officeapps.live.com/op/embed.aspx?src=".$path;
        }else{
            $cv_path = $path;
        }
        $categories = Categories::all();
        $cities = Cities::all();
        $regions = Regions::all();
        $jobtypes = JobType::all();
        $experiences = Experiences::all();
        $educations = Educations::all();
        $genders = Gender::all();
        return view('back.cv.edit',compact('categories','cities','regions','jobtypes','experiences','educations','genders','cv','cv_path'));
    }
    public function cvEditPost(Request $request){
        $request->validate([
            'name'=>'required',
            'surname'=>'required',
            'email'=>'required',
        ]);
        $cv = Cv::find($request->id);
        if(!$cv){
            return redirect()->route('cvList')->with('error',true);
        }
        $cv->category_id = $request->category;
        $cv->city_id = $request->city;
        if($request->city == '1'){
            $cv->region_id = $request->region;
        }

        $cv->education_id = $request->education;
        $cv->experience_id = $request->experience;
        $cv->job_type_id = $request->jobtype;
        $cv->gender_id = $request->gender;
        $cv->name = $request->name;
        $cv->surname = $request->surname;
        $cv->father_name = $request->father_name;
        $cv->email = $request->email;
        $cv->position = $request->position;
        $slug = Str::slug($cv->name.'_'.$cv->surname);
        if(Cv::where([['slug',$slug],['id','<>',$cv->id]])->first()){
            $slug = $slug.'_'.rand(1000,9999);
        }
        $cv->slug = $slug;
        $cv->about_education = $request->about_education;
        $cv->salary = $request->salary;
        $cv->birth_date = $request->birth;
        $cv->work_history = $request->work_experience;
        $cv->skills = $request->skills;
        $cv->contact_mail = $request->contact_mail;
        $cv->contact_phone = $request->contact_phone;
        $cv->portfolio = json_encode($request['group-a']);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024'
            ]);
            $image = $request->file('image');
            $name = 'cv_photo'.'_' .Str::random(6).'.' . $image->getClientOriginalExtension();
            $old_image = $cv->image;
            $directory = 'back/assets/images/cv_photo/';
            if (file_exists($old_image) && $old_image != 'back/assets/images/cv_photo/user.webp') {
                unlink($old_image);
            }
            $image->move($directory, $name);
            $name = $directory.$name;
            $cv->image = $name;
        }
        if ($request->hasFile('cv')) {
            $request->validate([
                'cv' => 'required|mimes:pdf|max:2000'
            ]);
            $image = $request->file('cv');
            $name = 'cv'.'_' .Str::random(6).'.' . $image->getClientOriginalExtension();
            $old_cv = $cv->cv;
            $directory = 'back/assets/images/cvs/';
            if (file_exists($old_cv)) {
                unlink($old_cv);
            }
            $image->move($directory, $name);
            $name = $directory.$name;
            $cv->cv = $name;
        }
        return redirect()->route('cvEdit',$request->id)->with($cv->save() ? 'success' : 'error',true);
    }
}

<?php

namespace App\Http\Controllers\Back\VacancyController;

use App\Http\Controllers\Controller;
use App\Models\AcceptType;
use App\Models\Categories;
use App\Models\Cities;
use App\Models\Companies;
use App\Models\Educations;
use App\Models\Experiences;
use App\Models\JobType;
use App\Models\Regions;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VacancyController extends Controller
{
    public function vacanciesList(){
        $vacancies = Vacancies::orderBy('id','DESC')->get();
        return view('back.vacancies.list',compact('vacancies'));
    }
    public function vacanciesAdd(){
        $companies = Companies::where('status','1')->get();
        $categories = Categories::all();
        $cities = Cities::all();
        $regions = Regions::all();
        $jobtypes = JobType::all();
        $experiences = Experiences::all();
        $educations = Educations::all();
        $types = AcceptType::all();
        return view('back.vacancies.add',compact('companies','categories','cities','regions','jobtypes','experiences','educations','types'));
    }
    public function vacanciesAddPost(Request $request){
        $request->validate([
                'category'=>'required|numeric',
                'company'=>'required|numeric',
                'city'=>'required|numeric',
                'jobtype'=>'required|numeric',
                'experience'=>'required|numeric',
                'education'=>'required|numeric',
                'title'=>'required|max:1000',
                'min_age'=>'required|numeric',
                'max_age'=>'required|numeric',
                'requirements'=>'required',
                'description'=>'required',
                'accept_type'=>'required|numeric',
                'deadline'=>'required|date',
        ]);
        $vacancy = new Vacancies();
        $vacancy->user_id = Auth::user()->id;
        $vacancy->company_id = $request->company;
        $vacancy->city_id = $request->city;
        if($request->city == 1){
            $request->validate([
               'region'=>'required|numeric'
            ]);
            $vacancy->village_id = $request->region;
        }
        $vacancy->category_id = $request->category;
        $vacancy->job_type_id = $request->jobtype;
        $vacancy->experience_id = $request->experience;
        $vacancy->education_id = $request->education;
        $vacancy->position = $request->title;
        $slug = Str::slug($request->title);
        if(Vacancies::where('slug',$slug)->first()){
            $slug = $slug.'_'.rand(1000,9999);
        }
        $vacancy->slug = $slug;
        if($request->salary_type == 'on'){
            $vacancy->salary_type = '1';
        }else{
            $vacancy->salary_type = '0';
            $request->validate([
                'min_salary'=>'required|numeric',
                'max_salary'=>'required|numeric',
            ]);
            $vacancy->min_salary = $request->min_salary;
            $vacancy->max_salary = $request->max_salary;
        }
        $vacancy->min_age = $request->min_age;
        $vacancy->max_age = $request->max_age;
        $vacancy->requirement = $request->requirements;
        $vacancy->description = $request->description;
        $vacancy->contact_name = $request->contact_name;
        $vacancy->accept_type = $request->accept_type;
        if($request->accept_type == '0' || $request->accept_type == '1'){
            $request->validate([
                'contact_email'=>'required|email'
            ]);
            $vacancy->contact_info = $request->contact_email;
        }else{
            $request->validate([
                'contact_link'=>'required'
            ]);
            $vacancy->contact_info = $request->contact_link;
        }
        $vacancy->deadline = $request->deadline;
        $vacancy->status = '1';

        return redirect()->route('vacanciesList')->with($vacancy->save() ? 'success' : 'error',true);
    }
    public function vacanciesEdit($id){
        $vacancy = Vacancies::find($id);
        if(!$vacancy){
            return redirect()->route('vacanciesList')->with('error',true);
        }
        $companies = Companies::where('status','1')->get();
        $categories = Categories::all();
        $cities = Cities::all();
        $regions = Regions::all();
        $jobtypes = JobType::all();
        $experiences = Experiences::all();
        $educations = Educations::all();
        $types = AcceptType::all();
        return view('back.vacancies.edit',compact('companies','categories','cities','regions','jobtypes','experiences','educations','types','vacancy'));
    }
    public function vacanciesEditPost(Request $request){
        $request->validate([
            'id'=>'required|numeric',
            'category'=>'required|numeric',
            'company'=>'required|numeric',
            'city'=>'required|numeric',
            'jobtype'=>'required|numeric',
            'experience'=>'required|numeric',
            'education'=>'required|numeric',
            'title'=>'required|max:1000',
            'min_age'=>'required|numeric',
            'max_age'=>'required|numeric',
            'requirements'=>'required',
            'description'=>'required',
            'accept_type'=>'required|numeric',
            'deadline'=>'required|date',
        ]);
        $vacancy = Vacancies::find($request->id);
        if(!$vacancy){
            return redirect()->route('vacanciesList')->with('error',true);
        }
        $vacancy->company_id = $request->company;
        $vacancy->city_id = $request->city;
        if($request->city == 1){
            $request->validate([
                'region'=>'required|numeric'
            ]);
            $vacancy->village_id = $request->region;
        }
        $vacancy->category_id = $request->category;
        $vacancy->job_type_id = $request->jobtype;
        $vacancy->experience_id = $request->experience;
        $vacancy->education_id = $request->education;
        $vacancy->position = $request->title;
        $slug = Str::slug($request->title);
        if(Vacancies::where([['slug',$slug],['id','<>',$request->id]])->first()){
            $slug = $slug.'_'.rand(1000,9999);
        }
        $vacancy->slug = $slug;
        if($request->salary_type == 'on'){
            $vacancy->salary_type = '1';
            $vacancy->min_salary = NULL;
            $vacancy->max_salary = NULL;
        }else{
            $vacancy->salary_type = '0';
            $request->validate([
                'min_salary'=>'required|numeric',
                'max_salary'=>'required|numeric',
            ]);
            $vacancy->min_salary = $request->min_salary;
            $vacancy->max_salary = $request->max_salary;
        }
        $vacancy->min_age = $request->min_age;
        $vacancy->max_age = $request->max_age;
        $vacancy->requirement = $request->requirements;
        $vacancy->description = $request->description;
        $vacancy->contact_name = $request->contact_name;
        $vacancy->accept_type = $request->accept_type;
        if($request->accept_type == '0' || $request->accept_type == '1'){
            $request->validate([
                'contact_email'=>'required|email'
            ]);
            $vacancy->contact_info = $request->contact_email;
        }else{
            $request->validate([
                'contact_link'=>'required'
            ]);
            $vacancy->contact_info = $request->contact_link;
        }
        $vacancy->deadline = $request->deadline;
        return redirect()->route('vacanciesEdit',$request->id)->with($vacancy->save() ? 'success' : 'error',true);
    }
    public function vacancyStatus(Request $request){
        $vacancy = Vacancies::find($request->id);
        if(!$vacancy){
          return response()->json(0);
        }
        $vacancy->status = $vacancy->status == '1' ? '0' : '1';
        return response()->json($vacancy->save() ? 1 : 0);
    }
    public function vacancyDelete(Request $request){
        $vacancy = Vacancies::find($request->id);
        if(!$vacancy){
            return response()->json(0);
        }
        return response()->json($vacancy->delete() ? 1 : 0);
    }
}

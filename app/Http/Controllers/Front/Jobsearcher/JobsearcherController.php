<?php

namespace App\Http\Controllers\Front\Jobsearcher;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Models\Categories;
use App\Models\Companies;
use App\Models\Vacancies;
use App\Models\JobType;
use App\Models\Educations;
use App\Models\Experiences;
use App\Models\Cities;
use App\Models\Gender;
use App\Models\Favorits;
use App\Models\BannerImage;

use DB;

class JobsearcherController extends Controller
{ 

    public function like(Request $request)
    {
        if(!auth()->check()) {
            return response()->json(['error' =>  __('messages.loginerror')], 403);
        }

        $cv_id = $request->input('cv_id');
        $user_id = auth()->user()->id;
        
        $favorite = new Favorits();
        $favorite->cv_id = $cv_id;
        $favorite->user_id = $user_id;
        $favorite->save();

    }


    public function dislike(Request $request)
    {
        if(!auth()->check()) {
            return redirect()->route('jobsearch')->with('error',  __('messages.loginerror'));
        }

        $cv_id = $request->input('cv_id');
        $user_id = auth()->user()->id;

        $favorite = Favorits::where('user_id', $user_id)->where('cv_id', $cv_id)->first();

        $favorite->delete();
        
    }


    public function detail($id){ 
        $banner = BannerImage::where('status','1')->get();

        $job = Cv::find($id);

        if (!$job) {
            abort(404);
        }
        $jobdetail = Cv::leftJoin('gender','gender.id','=','cv.gender_id')
        ->leftJoin('cities','cities.id','=','cv.city_id')
        ->leftJoin('categories','categories.id','=','cv.category_id')
        ->leftJoin('job_type','job_type.id','=','cv.job_type_id')
        ->leftJoin('educations','educations.id','=','cv.education_id')
        ->leftJoin('experiences','experiences.id','=','cv.experience_id')      
        ->where('cv.id', $id)
        ->select('cv.id','cv.image','cv.name','cv.surname','cv.about_education','cv.work_history','cv.skills','cv.salary','cv.contact_mail','cv.contact_phone','job_type.id as job_type_id','gender.title_az as gender_title','gender.id as gender_id','cities.id as city_id','categories.id as category_id','cv.position','educations.id as education_id','educations.title_az as edu_title','experiences.id as experience_id','experiences.title_az as exp_title','cv.status','cv.view','cv.created_at')
        ->first();
        if(auth()->check()){
            $likes = Favorits::whereUserId(auth()->user()->id)->get()->pluck('cv_id')->toArray();}
            else {
            $likes = [];
        }
        return View('front.Jobsearcher.detail', get_defined_vars());
    }

    public function downloadCV($id)
    {
        $jobdetail = Cv::find($id);
        $file_path = $jobdetail->cv;
        
        if (file_exists($file_path)) {
            return response()->download($file_path);
        } else {
            return __('messages.fileyox');
        }
    }


    public function jobsearch(Request $request)
        {
        $allcategories = Categories::where('status','1')->get();
        $job_types = JobType::where('status','1')->get();
        $educations = Educations::where('status','1')->get();
        $experiences = Experiences::where('status','1')->get();
        $cities = Cities::where('status','1')->get();
        $genders = Gender::where('status','1')->get();
        $morecvs = Cv::where('status','1')->orderBy('view','DESC')->take(10)->get();
        $banner = BannerImage::where('status','1')->get();

        if(auth()->check()){
            $likes = Favorits::whereUserId(auth()->user()->id)->get()->pluck('cv_id')->toArray();}
            else {
            $likes = [];
        }
        $allcvs = Cv::leftJoin('gender','gender.id','=','cv.gender_id')
            ->leftJoin('cities','cities.id','=','cv.city_id')
            ->leftJoin('categories','categories.id','=','cv.category_id')
            ->leftJoin('job_type','job_type.id','=','cv.job_type_id')
            ->leftJoin('educations','educations.id','=','cv.education_id')
            ->leftJoin('experiences','experiences.id','=','cv.experience_id')
            ->select('cv.id','cv.image','cv.name','cv.surname','job_type.id as job_type_id','gender.title_az','gender.id as gender_id','cities.id as city_id','categories.id as category_id','cv.position','educations.id as education_id','experiences.id as experience_id','cv.status','cv.view','cv.created_at')
            ->where('cv.status','1')
            ->orderBy('cv.created_at', 'desc');
            
            $allcvs = $allcvs->paginate(9)->appends(request()->except('page'));


        return View('front.Jobsearcher.jobsearcher', get_defined_vars());
    }



public function cvaxtar(Request $request){
    $banner = BannerImage::where('status','1')->get();

    $allcategories = Categories::where('status','1')->get();
    $job_types=JobType::where('status','1')->get();
    $educations=Educations::where('status','1')->get();
    $experiences=Experiences::where('status','1')->get();
    $cities=Cities::where('status','1')->get();
    $genders = Gender::where('status','1')->get();
    $morecvs = Cv::where('status','1')->orderBy('view','DESC')->take(10)->get();
    if(auth()->check()){
        $likes = Favorits::whereUserId(auth()->user()->id)->get()->pluck('cv_id')->toArray();}
        else {
        $likes = [];
    }
    $query = Cv::query();
    $vacname = $request->input('query');
    $city = $request->input('city');
    $category = $request->input('category');
    $find_worker = $request->input('find_worker');
    $education = $request->input('education');
    $experience = $request->input('experience');
    $gender = $request->input('gender');
    $sort_by = $request->input('sort_by');

    $query = $query->leftJoin('gender','gender.id','=','cv.gender_id')
        ->leftJoin('cities','cities.id','=','cv.city_id')
        ->leftJoin('categories','categories.id','=','cv.category_id')
        ->leftJoin('job_type','job_type.id','=','cv.job_type_id')
        ->leftJoin('educations','educations.id','=','cv.education_id')
        ->leftJoin('experiences','experiences.id','=','cv.experience_id')
        ->select('cv.id','cv.image','cv.name','cv.surname','job_type.id as job_type_id','gender.title_az','gender.id as gender_id','cities.id as city_id','categories.id as category_id','cv.position','educations.id as education_id','experiences.id as experience_id','cv.status','cv.view','cv.created_at')
        ->where('cv.status','1');
        
        if (!empty($vacname)) {
            $query->where(function ($q) use ($vacname) {
                $q->where('cv.slug', 'like', '%' . $vacname . '%')
                    ->orWhere('cv.position', 'like', '%' . $vacname . '%');
            });
        }
        
        if ($city) {
            $query->where('city_id', $city);
        }
        
        if ($category) {
            $query->where('category_id', $category);
        }
        
        if ($find_worker) {
            $query->where('job_type_id', $find_worker);
        }
        
        if ($education) {
            $query->where('education_id', $education);
        }
        
        if ($experience) {
            $query->where('experience_id', $experience);
        }
        
        if ($gender) {
            $query->where('gender_id', $gender);
        }
        
        $query->where('cv.status','1');
        

        if ($sort_by == '1') {
            $query->orderBy('cv.created_at', 'DESC');
        } if ($sort_by == '2') {
            $query->orderBy('cv.name', 'ASC');
        }if ($sort_by == '3') {
            $query->orderBy('cv.name', 'DESC');
        }
        
        $allcvs= $query->paginate(9)->appends(request()->except('page'));    
        
        return view('front.Jobsearcher.axtar', get_defined_vars());
}




    
}

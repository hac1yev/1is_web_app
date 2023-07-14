<?php

namespace App\Http\Controllers\Front\CV;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Companies;
use App\Models\Vacancies;
use App\Models\JobType;
use App\Models\Cv;
use App\Models\Educations;
use App\Models\Experiences;
use App\Models\Cities;
use App\Models\Regions;
use App\Models\Gender;
use App\Models\AcceptType;
use App\Models\BannerImage;
use App\Models\Favorits;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\SendCvMail;
use Illuminate\Support\Facades\Mail;

use DB;


class CVFrontController extends Controller
{ 
    public function cvAdd(){ 
        $banner = BannerImage::where('status','1')->get();

        $userId = auth()->user()->id;
        $cvs = Cv::where('user_id', $userId)->get();

        $categories = Categories::all();
        $cities = Cities::all();
        $regions = Regions::all();
        $jobtypes = JobType::all();
        $experiences = Experiences::all();
        $educations = Educations::all();
        $genders = Gender::all();

        if(auth()->check()){
            $likes = Favorits::whereUserId(auth()->user()->id)->get()->pluck('cv_id')->toArray();}
            else {
            $likes = [];
        }
        $favorits = User::join('favorits', 'favorits.user_id', '=', 'users.id')
        ->join('cv', 'favorits.cv_id', '=', 'cv.id')
        ->select('cv.id','cv.image','cv.name','cv.surname','cv.salary','cv.position','cv.status','cv.view','cv.created_at')
        ->where('favorits.user_id', $userId)
        ->distinct('favorits.cv_id')
        ->get();
        return View('front.CV.cv', get_defined_vars());
    }

    public function cvedit($id){ 
        $banner = BannerImage::where('status','1')->get();

        $cv=Cv::find($id);
        $userId = auth()->user()->id;

        if(!$cv || $cv->user_id !== $userId) {
            abort(404);
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
        return View('front.CV.cvedit', get_defined_vars());
    }


    public function cveditPost(Request $request){
        {
            
            $req = $request->all();
        $rules = [
            'position' => 'max:1000',
            'image' => 'image|mimes:jpg,png,jpeg|max:5000',
            'contact_mail' => 'nullable|email',
            'cv' => 'mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif,doc,docx,pdf|max:5000',
        ];
        
        
        $request->validate($rules);
       
        try {
            $cv = Cv::findOrFail($request->id);
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

            $portfolioData = [];


            $group = $request->input('group');
            if (is_array($group)) {
                
            
                foreach ($group as $index => $data) {
                    if ($data['work_name'] !== null || $data['work_company'] !== null || $data['work_link'] !== null) {
                        if (isset($portfolioData[$index])) {
                            $portfolioData[$index]['job_name'] = $data['work_name'] ?? "";
                            $portfolioData[$index]['company'] = $data['work_company'] ?? "";
                            $portfolioData[$index]['link'] = $data['work_link'] ?? "";
                        } else {
                            $portfolioData[] = [
                                'job_name' => $data['work_name'] ?? "",
                                'company' => $data['work_company'] ?? "",
                                'link' => $data['work_link'] ?? ""
                            ];
                        }
                    }
                }
            }

            $portfolio = [
                'portfolio' => $portfolioData
            ];

            $cv->portfolio = json_encode($portfolio);

                if ($request->hasFile('image')) {
                
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

            $cv->save();
           
            return redirect()->route('cvindex')->with('success', __('messages.cvyeni'));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
              return redirect()->route('cvindex')->with('error',$ex->getMessage());
          }
    }    
    

    }

    
    
    
    


    public function cvPost(Request $request){
        try {
            $req = $request->all();
        $rules = [
            'position' => 'max:1000',
            'image' => 'image|mimes:jpg,png,jpeg|max:5000',
            'contact_mail' => 'nullable|email',
            'cv' => 'mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif,doc,docx,pdf|max:5000',
        ];
        
        
        $request->validate($rules);
       
    
            $cv = new Cv();
            $cv->user_id = Auth::user()->id;
            $cv->city_id = $request->city;
            $cv->category_id = $request->category;
            $cv->job_type_id = $request->jobtype;
            $cv->experience_id = $request->experience;
            $cv->education_id = $request->education;
            $cv->gender_id = $request->gender;
            $cv->name = $request->name;
            $cv->surname = $request->surname;
            $cv->father_name = $request->father_name;
            $cv->email = $request->email;
            $cv->position = $request->position;
            $cv->salary = $request->salary;
            $cv->birth_date = $request->birth;
            $cv->image = $request->image;
            $cv->about_education = $request->about_education;
            $cv->work_history = $request->work_experience;
            $cv->skills = $request->skills;
            $portfolioData = [];
            $group = $request->input('group');

            if (!empty($group) && is_array($group)) {
                foreach ($group as $index => $data) {
                    if ($data['work_name'] !== null || $data['work_company'] !== null || $data['work_link'] !== null) {
                        $portfolioData[] = [
                            'job_name' => $data['work_name'] ?? "",
                            'company' => $data['work_company'] ?? "",
                            'link' => $data['work_link'] ?? ""
                        ];
                    }
                }
            }

            $portfolio = [
                'portfolio' => $portfolioData
            ];

            if (empty($portfolioData)) {
                $portfolio = [
                    'portfolio' => []
                ];
            }

            $cv->portfolio = json_encode($portfolio);


            $cv->contact_mail = $request->contact_mail;
            $cv->contact_phone = $request->contact_phone;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'cv_'.Str::random(6).'.'.$image->getClientOriginalExtension();
                $directory = 'back/assets/images/cv_photo/';
                $image->move($directory, $name);
                $name = $directory.$name;
                $cv->image = $name;
            }


            if ($request->hasFile('cv')) {
                $image = $request->file('cv');
                $name = 'cv_'.Str::random(6).'.'.$image->getClientOriginalExtension();
                $directory = 'back/assets/images/cvs/';
                $image->move($directory, $name);
                $name = $directory.$name;
                $cv->cv = $name;
            }

            $slug = Str::slug($cv->name.'_'.$cv->surname);
            if(Cv::where([['slug',$slug],['id','<>',$cv->id]])->first()){
                $slug = $slug.'_'.rand(1000,9999);
            }
            $cv->slug = $slug;
            $cv->status = '0';
            $data=[];
            $data['email_name']='1is.az';
            $data['subject']='Verification';
            $data['text']='Hörmətli istifadəçi,
        
            Cv-niz uğurla əlavə edildi.';        
        
            Mail::to($cv->email)->send(new SendCvMail($data));
            $cv->save();
    
            return redirect()->route('cvindex')->with('success', __('messages.succv'));
    
        } catch (\Throwable $e) {
            return redirect()->route('cvindex')->with('error',$e->getMessage());
        }
        }
    






}

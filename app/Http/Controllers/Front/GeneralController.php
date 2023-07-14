<?php

namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Blogs;
use App\Models\Companies;
use App\Models\Categories;
use App\Models\Cv;
use App\Models\Review;
use App\Models\Subsrcribers;
use App\Models\Trainings;
use App\Models\User;
use App\Models\Cities;
use App\Models\Vacancies;
use App\Models\Stories;
use App\Models\JobType;
use App\Models\Educations;
use App\Models\Favorits;
use App\Models\Experiences;
use App\Models\BannerImage;
use DB;

class GeneralController extends Controller
{ 
    public function index(Request $request){
        $stories = Stories::where('status','1')->get();

        $blogs = Blogs::where('status','1')->get();
        $banner = BannerImage::where('status','1')->get();
        $trainings = Trainings::where('status','1')->get();
        $allvacancies = Vacancies::where('status','1')->get();
        $non_vacancies = Vacancies::where('status','0')->get();
        $allcompanies = Companies::where('status','1')->orderBy('name','ASC')->get();
        $companies = Companies::where('status','1')->orderBy('view', 'DESC')->paginate(9);
        $cvs = Cv::where('status','1')->get();
        $cities=Cities::where('status','1')->get();
        $job_types=JobType::where('status','1')->get();
        $educations=Educations::where('status','1')->get();
        $experiences=Experiences::where('status','1')->get();
        $allcategories = Categories::where('status','1')->get();
        if (auth()->check()) {

        $userId = auth()->user()->cat_id;
        $user_cat = json_decode($userId);


        $vacancies = Vacancies::join('companies','companies.id','=','vacancies.company_id')
        ->join('categories','categories.id','=','vacancies.category_id')
        ->select('companies.id as company_id','companies.name','vacancies.id','vacancies.position',
        'vacancies.status','vacancies.view','categories.title_az','categories.title_en','categories.title_ru','categories.title_tr','vacancies.deadline','vacancies.created_at','vacancies.deadline')
        ->whereIn('vacancies.category_id', $user_cat)

        ->where('vacancies.status','1')->orderBy('vacancies.created_at', 'DESC')->paginate(40);

        }
        else{
            $vacancies = Vacancies::join('companies','companies.id','=','vacancies.company_id')
            ->join('categories','categories.id','=','vacancies.category_id')
            ->select('companies.id as company_id','companies.name','vacancies.id','vacancies.position',
            'vacancies.status','vacancies.view','categories.title_az','categories.title_en','categories.title_ru','categories.title_tr','vacancies.deadline','vacancies.created_at')
    
            ->where('vacancies.status','1')->orderBy('vacancies.created_at', 'DESC')->paginate(40);
        }

        if(auth()->check()){
          $likes = Favorits::whereUserId(auth()->user()->id)->get()->pluck('vacancy_id')->toArray();}
          else {$likes = [];}

        $categories = Categories::leftJoin('vacancies', 'vacancies.category_id', '=', 'categories.id')
        ->select('categories.*', DB::raw('COUNT(vacancies.id) as total_vacancies'))
        ->groupBy('categories.id')
        ->orderBy('total_vacancies', 'desc')
        ->paginate(12);
       

        return View('front.index', get_defined_vars());
    }


    public function loadMore(Request $request)
{
    $page = $request->input('page', 0);
    $limit = 12;
    $offset = ($page-1) * $limit;
    $totalCount = Categories::count();

    $categories = Categories::leftJoin('vacancies', 'vacancies.category_id', '=', 'categories.id')
        ->select('categories.*', DB::raw('COUNT(vacancies.id) as total_vacancies'))
        ->groupBy('categories.id')
        ->orderBy('total_vacancies', 'desc')
        ->skip($offset)
        ->take($limit)
        ->get();

    return response()->json([
        'data' => $categories,
        'totalCount' => $totalCount,
    ]);
}



public function loadLess(Request $request)
{
    $page = $request->input('page', 1);
    $limit = 12;
    $offset = ($page - 1) * $limit;
    $totalCount = Categories::count();
    $categories = [];

    if ($offset < $totalCount) {
        $categories = Categories::leftJoin('vacancies', 'vacancies.category_id', '=', 'categories.id')
            ->select('categories.*', DB::raw('COUNT(vacancies.id) as total_vacancies'))
            ->groupBy('categories.id')
            ->orderBy('total_vacancies', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();
    }

    return response()->json([
        'data' => $categories,
        'totalCount' => $totalCount,
    ]);
}

    public function like(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $vacancy_id = $request->input('vacancy_id');
        $user_id = auth()->user()->id;
        
        $favorite = new Favorits();
        $favorite->vacancy_id = $vacancy_id;
        $favorite->user_id = $user_id;

        $favorite->save();

        return redirect()->route('index')->with('success', 'Vakansiya favorilərə əlavə olundu!');
    }

    public function dislike(Request $request)
    {
        if(!auth()->check()) {
            return redirect()->route('index')->with('error',  __('messages.loginerror'));
        }

        $vacancy_id = $request->input('vacancy_id');
        $user_id = auth()->user()->id;

        $favorite = Favorits::where('user_id', $user_id)->where('vacancy_id', $vacancy_id)->first();

        $favorite->delete();
        return redirect()->route('index')->with('success', 'Vakansiya sevimlilərdən silindi!');
        
    }

      
}

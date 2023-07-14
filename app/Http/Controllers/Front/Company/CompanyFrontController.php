<?php

namespace App\Http\Controllers\Front\Company;

use App\Http\Controllers\Back\HelperController\HelperController;
use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Models\Categories;
use App\Models\Companies;
use App\Models\Sectors;
use App\Models\Cities;
use App\Models\Vacancies;
use App\Models\Review;
use App\Models\Rating;
use App\Models\Favorits;
use App\Models\BannerImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;
use DB;


class CompanyFrontController extends Controller 
{
    public function addComment(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
       
        try {
            
    
            $comment = new Review();
            $comment->user_id = Auth::user()->id;
    
            $comment->fullname = $request->fullname;
            $comment->message = $request->message;
            $comment->company_id = $request->company_id;
            if (!$request->has('rating')) {
                return redirect()->back()->with('error', __('messages.yildizerror'));
            }
            $comment->rating = $request->input('rating');
            $comment->save();
    
            return redirect()->route('compdetail', ['id' => $request->company_id])->with('success', __('messages.sucrey'));
        } catch (\Throwable $e) {
            return redirect()->route('compdetail', ['id' => $request->company_id])->with('error', $e->getMessage());
        }
    }
    

    public function compvac(Request $request, $id)
        {
            $compname = $request->input('query');
            $banner = BannerImage::where('status','1')->get();


            $query = Vacancies::join('companies', 'vacancies.company_id', '=', 'companies.id')
                ->join('categories', 'categories.id', '=', 'vacancies.category_id')
                ->where('companies.id', $id)
                ->where('vacancies.status', '1')
                ->select('vacancies.*', 'companies.name as company_name', 'vacancies.id as category_id', 'categories.title_az');

            if (!empty($compname)) {
                $query->where(function ($q) use ($compname) {
                    $q->where('vacancies.slug', 'like', '%' . $compname . '%');
                });
            }

            if (auth()->check()) {
                $likes = Favorits::whereUserId(auth()->user()->id)->get()->pluck('vacancy_id')->toArray();
            } else {
                $likes = [];
            }

            $compvacancies = $query->paginate(15)->appends(request()->except('page'));

            return view('front.Company.compvakans', get_defined_vars());
    }



    public function like(Request $request)
        {
        if(!auth()->check()) {
            return redirect()->route('compvac', ['id' => $request->vacancy_id])->with('error', __('messages.loginerror'));
        }

        $vacancy_id = $request->input('vacancy_id');
        $user_id = auth()->user()->id;
        
        $favorite = new Favorits();
        $favorite->vacancy_id = $vacancy_id;
        $favorite->user_id = $user_id;

        $favorite->save();

        return redirect()->route('compvac', ['id' => $request->vacancy_id])->with('success', 'Vakansiya favorilərə əlavə olundu!');
    }


    public function dislike(Request $request)
        {
        if(!auth()->check()) {
            return redirect()->route('compvac', ['id' => $request->vacancy_id])->with('error', 'Login olmadan sevimli işlərə əlavə edə bilməzsiniz!');
        }

        $vacancy_id = $request->input('vacancy_id');
        $user_id = auth()->user()->id;

        $favorite = Favorits::where('user_id', $user_id)->where('vacancy_id', $vacancy_id)->first();

        $favorite->delete();
        return redirect()->route('compvac', ['id' => $request->vacancy_id])->with('success', 'Vakansiya sevimlilərdən silindi!');
        
    }



    public function detail($id){

        $companyId = Companies::find($id);

        if (!$companyId || $companyId->status == 0) {
            abort(404);
        }

         /*average ve ulduz*/
        $ratings = DB::table('review')->where('company_id', $companyId->id)->where('status', '1')->pluck('rating');
        $totalRatings = $ratings->sum();
        $ratingCount = $ratings->count();
        $average = ($ratingCount > 0) ? round($totalRatings / $ratingCount) : 0;
        if (($average - floor($average)) > 0.5) {
            $average = ceil($average);
        } else {
            $average = floor($average);
        }
        
         /*comp ici*/
        $compdetail = Companies::join('sectors','sectors.id','=','companies.sector_id')
        ->where('companies.id', $id)
        ->select('sectors.id as sector_id','sectors.title_az','companies.*')
        ->first();
 
        /*comment yazma ve comment hissesi*/
        $comments = Review::join('companies', 'companies.id', '=', 'review.company_id')
        ->where('review.company_id', $id)
        ->where('review.status','1')
        ->select('review.rating', 'review.id as review_id','review.fullname', 'review.message', 'review.company_id', 'review.created_at as review_created', 'companies.id',)
        ->get();

        /*progres bar*/

        $ratingsbar5 = Review::join('companies', 'companies.id', '=', 'review.company_id')
        ->where('review.company_id', $id)
        ->where('review.status','1')
        ->where('review.rating','5')
        ->count();
        $ratingsbar4 = Review::join('companies', 'companies.id', '=', 'review.company_id')
        ->where('review.company_id', $id)
        ->where('review.status','1')
        ->where('review.rating','4')
        ->count();
        $ratingsbar3 = Review::join('companies', 'companies.id', '=', 'review.company_id')
        ->where('review.company_id', $id)
        ->where('review.status','1')
        ->where('review.rating','3')
        ->count();
        $ratingsbar2 = Review::join('companies', 'companies.id', '=', 'review.company_id')
        ->where('review.company_id', $id)
        ->where('review.status','1')
        ->where('review.rating','2')
        ->count();
        $ratingsbar1 = Review::join('companies', 'companies.id', '=', 'review.company_id')
        ->where('review.company_id', $id)
        ->where('review.status','1')
        ->where('review.rating','1')
        ->count();

        $totalRatings = Review::join('companies', 'companies.id', '=', 'review.company_id')
                    ->where('review.company_id', $id)
                    ->where('review.status','1')
                    ->count();
       

         /*faiz*/

        $companyCommentsCount = Review::where('company_id', $id)->where('status', '1')->count();
        $totalCommentsCount = Review::where('status', '1')->count();
        $faizcomment = intval($companyCommentsCount / $totalCommentsCount * 100);

         /*comp vaksniyalari*/
        $vacancies = Vacancies::join('companies', 'vacancies.company_id', '=', 'companies.id')
                      ->join('sectors','sectors.id','=','companies.sector_id')
                      ->where('companies.id', '=', $id)
                      ->where('vacancies.status', '=', '1')
                      ->select('vacancies.*', 'companies.id as company_id','companies.name as company_name', 'sectors.id as sector_id', 'sectors.title_az')
                      ->get();
                             
        /*vakansiya ve baxis sayi*/
        $activeVacanciesCount = $companyId->getVacancy()->where('status', 1)->count();
        $companyId->vacanc_say = $activeVacanciesCount;
        $companyId->view++;
        
        


        if(auth()->check()){
            $likes = Favorits::whereUserId(auth()->user()->id)->get()->pluck('vacancy_id')->toArray();}
            else {
            $likes = [];
        }
        $companyId->average = $average;
        $companyId->save();
        
        return view('front.Company.detail', get_defined_vars());
    }


    public function companies(Request $request){
        $sectors = Sectors::where('status','1')->orderBy('title_az','ASC')->get();
        $banner = BannerImage::where('status','1')->get();

        
        $allcompanies = Companies::join('sectors','sectors.id','=','companies.sector_id')
        ->select('companies.id','sectors.id as sector_id','companies.name','sectors.title_az','companies.status','companies.view','companies.created_at','companies.image','companies.user_id','companies.sector_id as compsector_id','companies.vacanc_say','companies.average')
        ->where('companies.status','1')
        ->orderBy('companies.id', 'DESC');

    
        
        
        $allcompanies = $allcompanies->paginate(15)->appends(request()->except('page'));
        

        return View('front.Company.company', get_defined_vars());
    }

    public function compsearch(Request $request){

        $sectors = Sectors::where('status','1')->orderBy('title_az','ASC')->get();
        $average = DB::table('companies')->pluck('average')->first();
        $banner = BannerImage::where('status','1')->get();

        $query = Companies::join('sectors','sectors.id','=','companies.sector_id')
            ->select('companies.id','sectors.id as sector_id','companies.name','sectors.title_az','companies.status','companies.view','companies.created_at','companies.image','companies.user_id','companies.sector_id as compsector_id','companies.vacanc_say','companies.average')
            ->where('companies.status','1');
    
        $compname = $request->input('query');
        $sector = $request->input('sector');
        $sort_by = $request->input('type');
       
        if (!empty($compname)) {
            $query->where(function ($q) use ($compname) {
                $q->where('companies.slug', 'like', '%' . $compname . '%');
            });
        }    
        if ($sector) {
            $query->where('companies.sector_id', $sector);
        }
    
        if ($sort_by == '1') {
            $query->orderBy('companies.name', 'ASC');
        } if ($sort_by == '2') {
            $query->orderBy('companies.name', 'DESC');
        } if ($sort_by == '3') {
            $query->orderBy('companies.view', 'DESC');
        } if ($sort_by == '4') {
            $query->orderBy('companies.vacanc_say', 'DESC');        
            

        }
    
        $allcompanies = $query->paginate(30)->appends(request()->except('page'));
    
        return view('front.Company.axtar', get_defined_vars());
    
    
    
    }   

    
    
}
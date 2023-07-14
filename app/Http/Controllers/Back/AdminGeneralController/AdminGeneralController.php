<?php

namespace App\Http\Controllers\Back\AdminGeneralController;

use App\Http\Controllers\Back\HelperController\HelperController;
use App\Http\Controllers\Controller;

use App\Models\Blogs;
use App\Models\Companies;
use App\Models\Cv;
use App\Models\Review;
use App\Models\Subsrcribers;
use App\Models\Trainings;
use App\Models\User;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminGeneralController extends Controller
{
    public function adminIndex(){
        $blogs = Blogs::where('status','1')->get();
        $trainings = Trainings::where('status','1')->get();
        $vacancies = Vacancies::where('status','1')->get();
        $non_vacancies = Vacancies::where('status','0')->get();
        $companies = Companies::where('status','1')->get();
        $cvs = Cv::where('status','1')->get();
        $subscribers = Subsrcribers::where('status','1')->get();
        $users = User::where([['is_admin','0'],['is_superadmin','0'],['status','1']])->get();
        $last_reviews = Review::orderBy('id','DESC')->limit(6)->get();


        return view('back.index',compact('blogs','users','trainings','vacancies','non_vacancies','companies','cvs','subscribers','last_reviews'));
    }
}

<?php

namespace App\Http\Controllers\Front\Policy;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\Models\BannerImage;

use DB;
//SELECT vacancies.position, COUNT(*) FROM vacancies GROUP BY category_id;
class PolicyController extends Controller
{ 
    public function index(){ 
        $banner = BannerImage::where('status','1')->get();

        $policies = Policy::first();

        return View('front.Policy.policy', get_defined_vars());
    }
}

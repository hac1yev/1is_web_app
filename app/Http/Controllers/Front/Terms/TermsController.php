<?php

namespace App\Http\Controllers\Front\Terms;
use App\Models\PrivacyCom;
use App\Models\PrivacyPro;
use App\Models\BannerImage;

use App\Http\Controllers\Controller;

use DB;
//SELECT vacancies.position, COUNT(*) FROM vacancies GROUP BY category_id;
class TermsController extends Controller
{ 
    public function index(){ 
        $banner = BannerImage::where('status','1')->get();

          $privcom = PrivacyCom::first();
          $privpro = PrivacyPro::first();

        return View('front.Terms.terms',get_defined_vars());
    }
}

<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\BannerImage;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

 
use DB;
//SELECT vacancies.position, COUNT(*) FROM vacancies GROUP BY category_id;
class BlogFrontController extends Controller
{
    public function detail($title, $id){
        $lang = config('app.locale');
        $banner = BannerImage::where('status','1')->get();

        $bdetail = Blogs::where('blogs.id', $id)
        
        ->select('blogs.*')
        ->first();


        $allblogs = Blogs::where('status', '1')->where('blogs.id', '!=', $id)->orderBy('view', 'DESC')->get();

                           
        return View('front.Blog.detail', get_defined_vars());
    }


    public function blogsearch(Request $request)
    {        
        $banner = BannerImage::where('status','1')->get();
        $locale = config('app.locale'); 
        $query = Blogs::where('status', '1');
        $blogs = $request->input('query');
        $sort_by = $request->input('type');

        if (!empty($blogs)) {
            $query->where(function ($q) use ($blogs) {
                $q->where('slug', 'like', '%' . $blogs . '%')
                    ->orWhere('content_az', 'like', '%' . $blogs . '%')
                    ->orWhere('content_ru', 'like', '%' . $blogs . '%')
                    ->orWhere('content_tr', 'like', '%' . $blogs . '%')
                    ->orWhere('content_en', 'like', '%' . $blogs . '%');
            });
        }
        if ($sort_by == '1') {
            if ($locale == 'EN') {
                $query->orderBy('blogs.title_en', 'ASC');
            } elseif ($locale == 'RU') {
                $query->orderBy('blogs.title_ru', 'ASC');
            } elseif ($locale == 'TR') {
                $query->orderBy('blogs.title_tr', 'ASC');
            } else {
                $query->orderBy('blogs.title_az', 'ASC');
            }
        }
         if ($sort_by == '2') {
            if ($locale == 'EN') {
                $query->orderBy('blogs.title_en', 'DESC');
            } elseif ($locale == 'RU') {
                $query->orderBy('blogs.title_ru', 'DESC');
            } elseif ($locale == 'TR') {
                $query->orderBy('blogs.title_tr', 'DESC');
            } else {
                $query->orderBy('blogs.title_az', 'DESC');
            }
        } if ($sort_by == '3') {
            $query->orderBy('blogs.view', 'DESC');
        } 
            

        $allblogs = $query->paginate(30)->appends(request()->except('page'));

        return view('front.Blog.axtar', get_defined_vars());
    }



    public function allblogs(){
        $moreview = Blogs::where('status','1')->orderby('view','DESC')->take(10)->get();
        $allblogs = Blogs::where('status', '1')->orderBy('created_at', 'DESC')->limit(PHP_INT_MAX)->get();
        $banner = BannerImage::where('status','1')->get();


        $perPage = 4;
        $page = request()->query('page', 1);

        $offset = ($page - 1) * $perPage;
        $bigblogs = $allblogs->slice($offset)->take(1);
        $middleblogs = $allblogs->slice($offset + 1)->take(1);
        $smallblogs = $allblogs->slice($offset + 2)->take(2);

        $mergedblogs = $bigblogs->merge($middleblogs)->merge($smallblogs);

        $paginatedBlogs = new LengthAwarePaginator(
            $mergedblogs->forPage($page, $perPage),
            $allblogs->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        
        return view('front.Blog.blog', get_defined_vars());
    }
}

<?php

namespace App\Http\Controllers\Front\Traning;

use App\Http\Controllers\Controller;
use App\Models\Trainings;
use App\Models\Companies;
use App\Models\BannerImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


use DB;
//SELECT vacancies.position, COUNT(*) FROM vacancies GROUP BY category_id;
class TraningFrontController extends Controller
{ 
    public function update(){ 
        return View('front.Traning.update');
    }

    public function detail($id){ 
        $banner = BannerImage::where('status','1')->get();

        $tdetail = Trainings::join('companies','companies.id','=','trainings.company_id')
        ->where('trainings.id', $id)
        ->select('companies.id as company_id','companies.name','trainings.*')
        ->first();

        $alltrainings = Trainings::join('companies','companies.id','=','trainings.company_id')
        ->select('companies.id as company_id','companies.name','trainings.*')
        ->where('trainings.status','1')
        ->where('trainings.id', '!=', $id)
        ->orderby('trainings.id','DESC')
        ->take(16)
        ->get();



        return View('front.Traning.detail', get_defined_vars());
    }

    public function alltrainings(){
        $banner = BannerImage::where('status','1')->get();

        $alltrainings = Trainings::join('companies','companies.id','=','trainings.company_id')
        ->select('companies.id','companies.name','trainings.company_id','trainings.id','trainings.title',
        'trainings.about','trainings.redirect_link','trainings.image','trainings.payment_type','trainings.price','trainings.view','trainings.deadline','trainings.status','trainings.created_at')
        ->where('trainings.status','1')->orderby('trainings.created_at','DESC')->paginate(12);
        
        return view('front.Traning.trainings', get_defined_vars());
    }


    public function telimaxtar(Request $request)
    {        
    $banner = BannerImage::where('status','1')->get();
    $query = Trainings::where('status', '1');
    $training = $request->input('query');
    $sort_by = $request->input('type');

    if (!empty($training)) {
        $query->where(function ($q) use ($training) {
            $q->where('slug', 'like', '%' . $training . '%')
                ->orWhere('title', 'like', '%' . $training . '%')
                ->orWhere('slug', 'like', '%' . $training . '%');
        });
    }
    if ($sort_by == '1') {
        $query->orderBy('trainings.title', 'ASC');
    } if ($sort_by == '2') {
        $query->orderBy('trainings.title', 'DESC');
    } if ($sort_by == '3') {
        $query->orderBy('trainings.view', 'DESC');
    }
        

    $alltrainings = $query->paginate(30)->appends(request()->except('page'));

    return view('front.Traning.axtar', get_defined_vars());
}



    public function trainingCreate(){
        $banner = BannerImage::where('status','1')->get();

        $userId = auth()->user()->id;
        $companies = Companies::where('user_id', $userId)->get();
        $trainings = Trainings::where('user_id', $userId)->get();

        return view('front.Traning.create', get_defined_vars());

    }


    public function trainingAddPost(Request $request){
        
        try {
            $request->validate([
                'title'=>'required',
                'company'=>'required',
                'link'=>'required',                
                'deadline' => 'required',
                'payment_type'=>'required',
                'about' => 'required',
                'image' => 'required',



            ]);

            $training = new Trainings();
            $training->user_id = Auth::user()->id;
            $training->company_id = $request->company;
            $training->title = $request->title;
            $slug = Str::slug($request->title);
            if(Trainings::where('slug',$slug)->first()){
                $slug = $slug.rand(1000,9999);
            }
            $training->slug = $slug;
            $training->about = $request->about;
            $training->redirect_link = $request->link;
            $training->payment_type = $request->payment_type;
            if($request->payment_type != 0){
                $training->price = $request->price;
            }
            $training->deadline = $request->deadline;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'training_'.Str::random(6).'.'.$image->getClientOriginalExtension();
                $directory = 'back/assets/images/trainings/';
                $image->move($directory, $name);
                $name = $directory.$name;
                $training->image = $name;
            }

            $training->save();
            return redirect()->route('traningcreate')->with('success', __('messages.suctelim'));
        } 
        catch (\Exception $e) {
            return redirect()->back()->with('error', __('messages.nesexeta'));
        }
        
    }

    public function trainingEdit($id){
        $banner = BannerImage::where('status','1')->get();

        $userId = auth()->user()->id;        
        $training = Trainings::find($id);

        if(!$training || $training->user_id !== $userId) {
            abort(404);
        }
        $companies = Companies::where('user_id', $userId)->get();

        if(!$training){
            return redirect()->route('traningcreate')->with('error', __('messages.melyox'));
        }
        return view('front.Traning.update', get_defined_vars());
    }
    
    public function trainingEditPost(Request $request){
        {
            $req = $request->all();
    
            $rules = [
                'company' => 'numeric',
                'payment_type' => 'numeric',
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:3072',
            ];
            
            $messages = [
                'company.numeric' => 'Şirket alanı sayısal olmalıdır.',
                'payment_type.numeric' => 'Ödeme türü alanı sayısal olmalıdır.',
                'image.image' => 'Yüklenen dosya bir resim olmalıdır.',
                'image.mimes' => 'Resim dosyası yalnızca :values formatında olabilir.',
                'image.max' => 'Resim dosyası en fazla :max kilobayt olmalıdır.',
            ];
            
            $request->validate($rules, $messages);
           
        try {
            $training = Trainings::find($request->id);
            if(!$training){
                return redirect()->route('traningcreate')->with('error',true);
            }
            
            $training->company_id = $request->company;
            $training->title = $request->title;
    
            $slug = Str::slug($request->title);
            if(Trainings::where([['slug',$slug],['id','<>',$training->id]])->first()){
                $slug = $slug.rand(1000,9999);
            }
            $training->slug = $slug;
            $training->about = $request->about;
            $training->redirect_link = $request->link;
            $training->payment_type = $request->payment_type;
    
            if($request->payment_type != 0){
                $training->price = $request->price;
            }else{
                $training->price = NULL;
            }
            $training->deadline = $request->deadline;
    
            if ($request->hasFile('image')) {
                $request->validate([
                    'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:3072',
                ]);
                $image = $request->file('image');
                $name = 'training_'.Str::random(6).'.'.$image->getClientOriginalExtension();
                $old_image = $training->image;
                if(file_exists($old_image)){
                    unlink($old_image);
                }
                $directory = 'back/assets/images/trainings/';
                $image->move($directory, $name);
                $name = $directory.$name;
                $training->image = $name;
            }
            
            $training->save();
    
            return redirect()->route('traningcreate')->with('success', __('messages.telimyeni'));
        } catch (\Exception $ex) {
            dd($e);
            die;
            return redirect()->route('traningcreate')->with('error', $ex->getMessage());
        }
        }
    }
    
    
}

<?php

namespace App\Http\Controllers\Back\AdminCompaniesController;

use App\Http\Controllers\Back\HelperController\HelperController;
use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\Sectors;
use App\Models\Trainings;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminCompaniesController extends Controller
{
    public function companiesList(){
        $companies = Companies::orderBy('created_at','DESC')->get();
        return view('back.companies.list',compact('companies'));
    }
    public function companiesAdd(){
        $sectors = Sectors::where('status','1')->get();
        return view('back.companies.add',compact('sectors'));
    }
    public function companiesAddPost(Request $request){
        $request->validate([
            'sector'=>'numeric',
            'about'=>'min:20',
            'address'=>'max:255',
            'website'=>'|max:255',
            'instagram'=>'max:255',
            'facebook'=>'max:255',
            'linkedin'=>'max:255',
            'twitter'=>'max:255',
            'image'=>'image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024',
        ]);

        $company = new Companies();
        $company->user_id = Auth::user()->id;
        $company->sector_id  = $request->sector;
        $company->name = $request->name;
        $slug = Str::slug($request->name);
        if(Companies::where('slug',$slug)->first()){
            $slug = $slug.rand(1000,9999);
        }
        $company->slug = $slug;
        $company->about = $request->about;
        $company->hr = $request->hr;
        $company->address = $request->address;
        $company->website = $request->website;
        $company->map = $request->map;
        $company->instagram = $request->instagram;
        $company->facebook = $request->facebook;
        $company->linkedin = $request->linkedin;
        $company->twitter = $request->twitter;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'company_'.Str::random(6).'.'.$image->getClientOriginalExtension();
            $directory = 'back/assets/images/companies/';
            $image->move($directory, $name);
            $name = $directory.$name;
            $company->image = $name;
        }
        return redirect()->route('companiesList')->with($company->save() ? 'success' : 'error',true);
    }
    public function companiesStatus(Request $request){
        $company = Companies::find($request->id);
        if(!$company){
            return response()->json(0);
        }
        $vacancies = Vacancies::where('company_id',$company->id)->get();
        foreach ($vacancies as $vacancy){
            $vacancy->status = $company->status == 1 ? '0' : '1';
            $vacancy->save();
        }
        $trainings = Trainings::where('company_id',$company->id)->get();
        foreach ($trainings as $training){
            $training->status = $company->status == 1 ? '0' : '1';
            $training->save();
        }
        $company->status = $company->status == 1 ? '0' : '1';
        return $company->save() ? response()->json(1) : response()->json(0);
    }
    public function companiesEdit($id){
        $company = Companies::find($id);
        if(!$company){
            return redirect()->route('companiesList')->with('error',true);
        }
        $sectors = Sectors::where('status','1')->get();
        return view('back.companies.edit',compact('sectors','company'));
    }
    public function companiesEditPost(Request $request){
        $request->validate([
            'id'=>'required',
            'sector'=>'required|numeric',
            'name'=>'required',
            'about'=>'required|min:20',
            'address'=>'required|max:255',
            'website'=>'required|max:255',
            'map'=>'required',

        ]);
        $company = Companies::find($request->id);
        $company->sector_id  = $request->sector;
        $company->name = $request->name;
        $slug = Str::slug($request->name);
        if(Companies::where([['slug',$slug],['id','<>',$company->id]])->first()){
            $slug = $slug.rand(1000,9999);
        }
        $company->slug = $slug;
        $company->about = $request->about;
        $company->hr = $request->hr;
        $company->address = $request->address;
        $company->website = $request->website;
        $company->map = $request->map;
        $company->instagram = $request->instagram;
        $company->facebook = $request->facebook;
        $company->linkedin = $request->linkedin;
        $company->twitter = $request->twitter;
        if ($request->hasFile('image')) {
            $request->validate([
                'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024',
            ]);
            $image = $request->file('image');
            $name = 'company_'.Str::random(6).'.'.$image->getClientOriginalExtension();
            $old_image = $company->image;
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $directory = 'back/assets/images/companies/';
            $image->move($directory, $name);
            $name = $directory.$name;
            $company->image = $name;
        }
        return redirect()->route('companiesEdit',$request->id)->with($company->save() ? 'success' : 'error',true);
    }
    public function companiesDelete(Request $request){
        $company = Companies::find($request->id);
        if(!$company){
            return response()->json(0);
        }
        $old_image = $company->image;
        if(file_exists($old_image)){
            unlink($old_image);
        }
 
        $vacancies = Vacancies::where('company_id',$company->id)->get();
        foreach ($vacancies as $vacancy){
            $vacancy->delete();
        }
        $trainings = Trainings::where('company_id',$company->id)->get();
        foreach ($trainings as $training){
            $training->delete();
        }
        return $company->delete() ? response()->json(1) : response()->json(0);
    }
}

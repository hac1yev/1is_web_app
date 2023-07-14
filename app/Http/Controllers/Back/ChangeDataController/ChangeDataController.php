<?php

namespace App\Http\Controllers\Back\ChangeDataController;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\Trainings;
use App\Models\Vacancies;
use App\Models\Review;
use App\Models\User;

use Illuminate\Http\Request;

class ChangeDataController extends Controller
{
    public function companiesDataIndex(){
        $companies = Companies::where('status','1')->get();
        return view('back.change.company',compact('companies'));
    }
    public function companiesDataPost(Request $request){
        $request->validate([
           'request_company'=>'required|numeric',
           'accept_company'=>'required|numeric',
        ]);
        if($request->request_company == $request->accept_company){
            return redirect()->back()->with('error',true);
        }
        $old_company = Companies::find($request->request_company);
        $new_company = Companies::find($request->accept_company);
        if(!$old_company || !$new_company){
            return redirect()->back()->with('error',true);
        }
        $new_company->sector_id = $new_company->sector_id;
        $new_company->about = $new_company->about;
        $new_company->hr = $new_company->hr;
        $new_company->average = $old_company->average;
        $new_company->slug = $new_company->slug;
        $new_company->address = $new_company->address;
        $new_company->website = $new_company->website;
        $new_company->map = $new_company->map;
        $new_company->instagram = $new_company->instagram;
        $new_company->linkedin = $new_company->linkedin;
        $new_company->facebook = $new_company->facebook;
        $new_company->twitter = $new_company->twitter;
        $new_company->image = $new_company->image;
        $new_company->view = $old_company->view;
        $new_company->status = $old_company->status;
        $new_company->save();
        $vacancies = Vacancies::where('company_id',$old_company->id)->get();
    
        foreach ($vacancies as $vacancy) {
            $vacancy->update(['company_id' => $new_company->id]);
        }

        $reviews = Review::where('company_id',$old_company->id)->get();
        foreach ($reviews as $rev) {
            $rev->update(['company_id' => $new_company->id]);
        }

        $user = Companies::where('user_id',$old_company->user_id)->get();
        foreach ($user as $u) {
            $rev->update(['user_id' => $new_company->user_id]);
        }

        $trainings = Trainings::where('company_id',$old_company->id)->get();
        foreach ($trainings as $training){
            $training->update(['company_id' => $new_company->id]);

        }
        $old_company->delete();
        return redirect()->back()->with('success',true);
    }
}

<?php

namespace App\Http\Controllers\Back\HelperController;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\Cv;
use App\Models\Cvs;
use App\Models\Training;
use App\Models\Trainings;
use App\Models\Vacancies;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HelperController extends Controller
{
    public static function changeData(){
        $companies = Company::all();
        $count = count($companies);
        $number = 0;
        foreach ($companies as $company){
            $new_company = new Companies();
            $new_company->id = $company->id;
            $new_company->user_id = $company->user_id;
            $new_company->sector_id = $company->sector;
            $new_company->name = $company->title;
            $new_company->slug = Str::slug($company->title);
            $new_company->about = $company->about;
            $new_company->hr = $company->hr;
            $new_company->address = $company->address;
            $new_company->website = $company->website;
            $new_company->map = $company->map;
            $new_company->instagram = $company->instagram;
            $new_company->linkedin = $company->linkedin;
            $new_company->facebook = $company->facebook;
            $new_company->twitter = $company->twitter;
            $image_path = explode('/',$company->logo);
            $path = 'back/assets/images/company/'.$image_path[1];
            $new_company->image = $path;
            $new_company->view = $company->view;
            if($company->status == 1){
                $new_company->status = '1';
            }else if($company->status == 0){
                $new_company->status = '0';
            }else{
                $new_company->status = '1';
            }
            if($new_company->save()){
                $number++;
            }
        }
        if($count == $number){
            dd('success');
        }else{
            dd('errrrrrrrrooooooorrrrr');
        }
    }
    public static function convertImage(){
        $companies = Companies::limit(3)->get();
        $count = count($companies);
        $number = 0;
        foreach ($companies as $company){
            if(file_exists($company->image)){
                $image = File::allFiles(public_path());
                $directory = 'back/assets/images/companies/';
                $name = Str::slug($company->name).'_'. Str::random(6);
                Storage::move($company->image, $directory);
                $name = $directory.$name;
                $company->image = $name;
                if($company->save()){
                    $number++;
                }
            }
        }
        if($count == $number){
            dd('success');
        }else{
            dd('errrrrrrrrooooooorrrrr');
        }
    }
    public static function fixImage(){
        $companies = Company::all();
        $number = 0;
        foreach ($companies as $company){
            $old_company = Companies::find($company->id);
            if($old_company){
                $number++;
                $path = explode('/',$company->logo);
                $image_path = 'back/assets/images/company/'.$path[1];
                $old_company->image = $image_path;
                $old_company->save();
            }else{
                $number++;

            }
        }
        dd($number);
    }
    public static function changeDataTraining(){
        $traingins = Training::all();
        $count = count($traingins);
        $number = 0;
        foreach ($traingins as $training){
            $new_training = new Trainings();
            $new_training->id = $training->id;
            $new_training->user_id = '1';
            $new_training->company_id = $training->company_id;
            $new_training->title = $training->name;
            $new_training->slug = Str::slug($training->name);
            $new_training->about = $training->about;
            $new_training->redirect_link = $training->redirect_link;
            $image_path = explode('/',$training->image);
            $path = 'back/assets/images/trainings/'.$image_path[1];
            $new_training->image = $path;
            $new_training->payment_type = $training->payment_type;
            if($training->payment_type != '0'){
                $new_training->price = $training->price;
            }
            $new_training->view = $training->view;
            $new_training->deadline = $training->deadline;
            $new_training->status = $training->status;
            $new_training->created_at = $training->created;
            if($new_training->save()){
                $number++;
            }
        }
        if($count == $number){
            dd('success');
        }else{
            dd('errrrrrrrrooooooorrrrr');
        }
    }
    public static function changeVacancyData(){
        $vacancies = Vacancy::all();
        $count = count($vacancies);
        $number = 0;
        foreach ($vacancies as $vacancy){
            $data = new Vacancies();
            $data->user_id = '1';
            $data->company_id = $vacancy->company;
            $data->city_id = $vacancy->city;
            $data->category_id = $vacancy->category;
            $data->job_type_id = $vacancy->work_type;
            $data->experience_id = $vacancy->experience;
            $data->education_id = $vacancy->education;
            $data->position = $vacancy->position;
            if($vacancy->salary_other == '0'){
                $data->min_salary = $vacancy->min_salary;
                $data->max_salary = $vacancy->max_salary;
                $data->salary_type = '0';
            }else{
                $data->salary_type = '1';
            }
            $data->min_age = $vacancy->min_age;
            $data->max_age = $vacancy->max_age;
            $data->requirement = $vacancy->requirements;
            $data->description = $vacancy->description;
            $data->contact_name = $vacancy->contact;
            if($vacancy->cv_accept == '1'){
                $data->accept_type = '0';
            }elseif($vacancy->cv_accept == '2'){
                $data->accept_type = '1';
            }else{
                $data->accept_type = '2';
            }
            $data->contact_info = $vacancy->contact_info;
            $data->deadline = $vacancy->expire;
            if($vacancy->expire == '0000-00-00'){
                $data->deadline = '2023-02-01';
            }

            $data->status = $vacancy->status;
            $data->view = $vacancy->viewed;
            $data->created_at = $vacancy->created;
            if($data->save()){
                $number++;
            }
        }
        if($count == $number){
            dd('success');
        }else{
            dd('errrrrrrrrooooooorrrrr');
        }
    }
    public static function addSlugVacancy(){
        $datas = Vacancies::all();
        $count = count($datas);
        $number = 0;
        foreach ($datas as $data){
            if(isset($data->slug)){
                $slug = Str::slug($data->position);
                if(Vacancies::where([['slug',$slug],['id','<>',$data->id]])->first()){
                    $slug = $slug.'_'.rand(1000,9999);
                }
                $data->slug = $slug;
                if($data->save()){
                    $number++;
                }
            }

        }
        if($number == $count){
            dd('sssssss');
        }else{
            dd('errrrrrrr');
        }
    }
    public static function convertCvData(){
        $cvs = Cvs::all();
        $count = count($cvs);
        $number = 0;
        foreach ($cvs as $cv) {
            $data = new Cv();
            $data->id = $cv->id;
            $data->user_id = '1';
            $data->category_id = $cv->category;
            $data->city_id = $cv->city;
            $data->education_id = $cv->education;
            $data->experience_id = $cv->experience;
            $data->job_type_id = $cv->work_type;
            $data->gender_id = $cv->gender;
            $data->name = $cv->name;
            $data->surname = $cv->surname;
            $data->father_name = $cv->father_name;
            $data->email = $cv->email;
            $data->position = $cv->position;
            $slug = Str::slug($cv->name.'_'.$cv->surname);
            if(Cv::where([['slug',$slug],['id','<>',$cv->id]])->first()){
                $slug = $slug.'_'.rand(1000,9999);
            }
            $data->slug = $slug;
            $data->about_education = $cv->about_education;
            $data->salary = $cv->salary;

            $data->work_history = $cv->work_history;
            $data->skills = $cv->skills;
            $data->contact_mail = $cv->contact_mail;
            $data->contact_phone = $cv->contact_phone;
            $data->portfolio = $cv->portfolio;
            $url = explode('/',$cv->photo);
            $image = 'back/assets/images/cv_photo/'.$url[1];
            $data->image = $image;
            $cv_url = explode('/',$cv->cv);
            if(count($cv_url) == 4){
                $cv_path = 'back/assets/images/cvs/'.$cv_url[3];
            }else{
                $cv_path = 'back/assets/images/cvs/'.$cv_url[1];
            }

            $data->cv = $cv_path;
            if($data->save()){
                $number++;
            }

        }
        if($number == $count){
            dd('sssssss');
        }else{
            dd('errrrrrrr');
        }
    }
    public static function addSlugCompanies(){
        $companies = Companies::all();
        $count = count($companies);
        $number = 0;
        foreach ($companies as $company){
            $slug = Str::slug($company->name);
            if(Companies::where([['slug',$slug],['id','<>',$company->id]])->first()){
                $slug = $slug.'_'.rand(1000,9999);
            }
            $company->slug = $slug;
            if($company->save()){
                $number++;
            }
        }
        if($number == $count){
            dd('sssssss');
        }else{
            dd('errrrrrrr');
        }
    }
}

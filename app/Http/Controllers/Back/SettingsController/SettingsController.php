<?php

namespace App\Http\Controllers\Back\SettingsController;

use App\Http\Controllers\Controller;
use App\Models\AcceptType;
use App\Models\Categories;
use App\Models\Cities;
use App\Models\Educations;
use App\Models\Experiences;
use App\Models\Gender;
use App\Models\JobType;
use App\Models\Language;
use App\Models\Regions;
use App\Models\Sectors;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function settingsSeoIndex(){ 
        $settings = Settings::first();

        return view('back.settings.seo',compact('settings'));
    }
    public function settingsSeoPost(Request $request){
        $languages = Language::all();

        foreach ($languages as $language) {
            $request->validate([
                'meta_title_' . $language->shortname => 'required',
                'meta_description_' . $language->shortname => 'required',
                'meta_keywords_' . $language->shortname => 'required',
            ]);
        }
        $settings = Settings::first();
        foreach ($languages as $language) {
            $title = 'meta_title_' . $language->shortname;
            $desc = 'meta_description_' . $language->shortname;
            $keywords = 'meta_keywords_' . $language->shortname;

            $settings->$title = $request->$title;
            $settings->$desc = $request->$desc;
            $settings->$keywords = $request->$keywords;
        }
        return redirect()->back()->with($settings->save() ? 'success' : 'error',true);
    }
    public function settingsLogoIndex(){
        $settings = Settings::first();
        return view('back.settings.logo',compact('settings'));
    }
    public function settingsLogoPost(Request $request){
        $setting = Settings::first();
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024'
            ]);
            $image = $request->file('image');
            $name = 'logo_' .Str::random(6).'.' . $image->getClientOriginalExtension();
            $old_image = $setting->logo;
            $directory = 'back/assets/images/logos/';
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            $image->move($directory, $name);
            $name = $directory.$name;
            $setting->logo = $name;

            return redirect()->back()->with($setting->save() ? ' success' : 'error',true);
        }
        return redirect()->back()->with('empty_logo',true);
    }
    public function settingsFaviconPost(Request $request){
        $setting = Settings::first();
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg,webp,jfif,avif|max:1024'
            ]);
            $image = $request->file('image');
            $name = 'favicon_' .Str::random(6).'.' . $image->getClientOriginalExtension();
            $old_image = $setting->favicon;
            $directory = 'back/assets/images/logos/';
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            $image->move($directory, $name);
            $name = $directory.$name;
            $setting->favicon = $name;

            return redirect()->back()->with($setting->save() ? ' success' : 'error',true);
        }
        return redirect()->back()->with('empty_favicon',true);
    }
    public function settingsCategoriesIndex(){
        $categories = Categories::orderBy('id','DESC')->get();
        $languages = Language::all();
        return view('back.settings.category',compact('categories','languages'));
    }
    public function settingsCategoriesEdit(Request $request){
        $category = Categories::find($request->id);
        return $category ?? '0';
    }

    public function categoriesStatus(Request $request){
        $category = Categories::find($request->id);
          
        if(!$category){
          return '0';
      }
      $category->status = $category->status == '0' ? '1' : '0';
      return $category->save() ? '1' : '0';
    }
    public function settingsCategoriesPost(Request $request){
        $languages = Language::all();
       $request->validate([
          'id'=>'required',
          'title_az'=>'required',
          'title_en'=>'required',
          'title_ru'=>'required',
          'title_tr'=>'required',
          'icon'=>'required',
       ]);
       $category= Categories::find($request->id);
       $slug = Str::slug($request->title_az);
       $old_category = Categories::where([['slug',$slug],['id','<>',$category->id]])->first();
       if($old_category){
           $slug = $slug.'_'.rand(1000,9999);
       }
       foreach ($languages as $language){
           $title = 'title_'.$language->shortname;

           $category->$title = $request->$title;
       }
       $category->icon = $request->icon;
       $category->slug = $slug;
       return redirect()->back()->with($category->save() ? 'success' : 'error',true);
    }
    public function settingsCategoriesAdd(Request $request){
        $languages = Language::all();
        $request->validate([
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
            'icon'=>'required',
        ]);
        $category= new Categories();
        $slug = Str::slug($request->title_az);
        $old_category = Categories::where('slug',$slug)->first();
        if($old_category){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $category->$title = $request->$title;
        }
        $category->icon = $request->icon;
        $category->slug = $slug;
        return redirect()->back()->with($category->save() ? 'success' : 'error',true);
    }
    public function settingsSectorsIndex(){
        $sectors = Sectors::orderBy('id','DESC')->get();
        $languages = Language::all();
        return view('back.settings.sector',compact('sectors','languages'));
    }
    public function sectorsStatus(Request $request){
        $sectors = Sectors::find($request->id);
          
        if(!$sectors){
          return '0';
      }
      $sectors->status = $sectors->status == '0' ? '1' : '0';
      return $sectors->save() ? '1' : '0';
    }
    public function settingsSectorsEdit(Request $request){
        $sector = Sectors::find($request->id);
        return $sector ?? '0';
    }
    public function settingsSectorsPost(Request $request){
        $languages = Language::all();
        $request->validate([
            'id'=>'required',
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $sector= Sectors::find($request->id);
        $slug = Str::slug($request->title_az);
        $old_sector = Sectors::where([['slug',$slug],['id','<>',$sector->id]])->first();
        if($old_sector){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $sector->$title = $request->$title;
        }
        $sector->slug = $slug;
        return redirect()->back()->with($sector->save() ? 'success' : 'error',true);
    }
    public function settingsSectorsAdd(Request $request){
        $languages = Language::all();
        $request->validate([
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $sector= new Sectors();
        $slug = Str::slug($request->title_az);
        $old_sector = Sectors::where('slug',$slug)->first();
        if($old_sector){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $sector->$title = $request->$title;
        }
        $sector->slug = $slug;
        return redirect()->back()->with($sector->save() ? 'success' : 'error',true);
    }
    public function settingsCitiesIndex(){
        $cities = Cities::orderBy('id','DESC')->get();
        $languages = Language::all();
        return view('back.settings.city',compact('cities','languages'));
    }

    public function citiesStatus(Request $request){
        $cities = Cities::find($request->id);
          
        if(!$cities){
          return '0';
      }
      $cities->status = $cities->status == '0' ? '1' : '0';
      return $cities->save() ? '1' : '0';
    }
    public function settingsCitiesEdit(Request $request){
        $city = Cities::find($request->id);
        return $city ?? '0';
    }
    public function settingsCitiesPost(Request $request){
        $languages = Language::all();
        $request->validate([
            'id'=>'required',
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $city= Cities::find($request->id);
        $slug = Str::slug($request->title_az);
        $old_city = Cities::where([['slug',$slug],['id','<>',$city->id]])->first();
        if($old_city){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $city->$title = $request->$title;
        }
        $city->slug = $slug;
        return redirect()->back()->with($city->save() ? 'success' : 'error',true);
    }
    public function settingsCitiesAdd(Request $request){
        $languages = Language::all();
        $request->validate([
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $city= new Cities();
        $slug = Str::slug($request->title_az);
        $old_city = Sectors::where('slug',$slug)->first();
        if($old_city){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $city->$title = $request->$title;
        }
        $city->slug = $slug;
        return redirect()->back()->with($city->save() ? 'success' : 'error',true);
    }
    public function settingsEducationIndex(){
        $educations = Educations::orderBy('id','DESC')->get();
        $languages = Language::all();
        return view('back.settings.education',compact('educations','languages'));
    }

    public function educationStatus(Request $request){
        $education = Educations::find($request->id);
          
        if(!$education){
          return '0';
      }
      $education->status = $education->status == '0' ? '1' : '0';
      return $education->save() ? '1' : '0';
    }
    public function settingsEducationEdit(Request $request){
        $education = Educations::find($request->id);
        return $education ?? '0';
    }
    public function settingsEducationPost(Request $request){
        $languages = Language::all();
        $request->validate([
            'id'=>'required',
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $education= Educations::find($request->id);
        $slug = Str::slug($request->title_az);
        $old_education = Educations::where([['slug',$slug],['id','<>',$education->id]])->first();
        if($old_education){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $education->$title = $request->$title;
        }
        $education->slug = $slug;
        return redirect()->back()->with($education->save() ? 'success' : 'error',true);
    }
    public function settingsEducationAdd(Request $request){
        $languages = Language::all();
        $request->validate([
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $education= new Educations();
        $slug = Str::slug($request->title_az);
        $old_educaiton = Educations::where('slug',$slug)->first();
        if($old_educaiton){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $education->$title = $request->$title;
        }
        $education->slug = $slug;
        return redirect()->back()->with($education->save() ? 'success' : 'error',true);
    }
    public function settingsExperienceIndex(){
        $experiences = Experiences::orderBy('id','DESC')->get();
        $languages = Language::all();
        return view('back.settings.experience',compact('experiences','languages'));
    }

    public function experienceStatus(Request $request){
        $experience = Experiences::find($request->id);
          
        if(!$experience){
          return '0';
      }
      $experience->status = $experience->status == '0' ? '1' : '0';
      return $experience->save() ? '1' : '0';
    }
    public function settingsExperienceEdit(Request $request){
        $experience = Experiences::find($request->id);
        return $experience ?? '0';
    }
    public function settingsExperiencePost(Request $request){
        $languages = Language::all();
        $request->validate([
            'id'=>'required',
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $experience= Experiences::find($request->id);
        $slug = Str::slug($request->title_az);
        $old_experience = Experiences::where([['slug',$slug],['id','<>',$experience->id]])->first();
        if($old_experience){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $experience->$title = $request->$title;
        }
        $experience->slug = $slug;
        return redirect()->back()->with($experience->save() ? 'success' : 'error',true);
    }
    public function settingsExperienceAdd(Request $request){
        $languages = Language::all();
        $request->validate([
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $experience= new Experiences();
        $slug = Str::slug($request->title_az);
        $old_experience = Experiences::where('slug',$slug)->first();
        if($old_experience){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $experience->$title = $request->$title;
        }
        $experience->slug = $slug;
        return redirect()->back()->with($experience->save() ? 'success' : 'error',true);
    }
    public function settingsRegionsIndex(){
        $regions = Regions::orderBy('id','DESC')->get();
        $languages = Language::all();
        return view('back.settings.regions',compact('regions','languages'));
    }
    public function regionsStatus(Request $request){
        $regions = Regions::find($request->id);
          
        if(!$regions){
          return '0';
      }
      $regions->status = $regions->status == '0' ? '1' : '0';
      return $regions->save() ? '1' : '0';
    }
    public function settingsRegionsEdit(Request $request){
        $region = Regions::find($request->id);
        return $region ?? '0';
    }
    public function settingsRegionsPost(Request $request){
        $languages = Language::all();
        $request->validate([
            'id'=>'required',
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $region= Regions::find($request->id);
        $slug = Str::slug($request->title_az);
        $old_region = Regions::where([['slug',$slug],['id','<>',$region->id]])->first();
        if($old_region){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $region->$title = $request->$title;
        }
        $region->slug = $slug;
        $region->city_id = '1';
        return redirect()->back()->with($region->save() ? 'success' : 'error',true);
    }
    public function settingsRegionsAdd(Request $request){
        $languages = Language::all();
        $request->validate([
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $region= new Regions();
        $slug = Str::slug($request->title_az);
        $old_region = Regions::where('slug',$slug)->first();
        if($old_region){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $region->$title = $request->$title;
        }
        $region->slug = $slug;
        $region->city_id = '1';
        return redirect()->back()->with($region->save() ? 'success' : 'error',true);
    }
    public function settingsGendersIndex(){
        $genders = Gender::orderBy('id','DESC')->get();
        $languages = Language::all();
        return view('back.settings.gender',compact('genders','languages'));
    }
    public function gendersStatus(Request $request){
        $gender = Gender::find($request->id);
          
        if(!$gender){
          return '0';
      }
      $gender->status = $gender->status == '0' ? '1' : '0';
      return $gender->save() ? '1' : '0';
    }
    public function settingsGendersEdit(Request $request){
        $gender = Gender::find($request->id);
        return $gender ?? '0';
    }
    public function settingsGendersPost(Request $request){
        $languages = Language::all();
        $request->validate([
            'id'=>'required',
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $gender= Gender::find($request->id);
        $slug = Str::slug($request->title_az);
        $old_gender = Gender::where([['slug',$slug],['id','<>',$gender->id]])->first();
        if($old_gender){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $gender->$title = $request->$title;
        }
        $gender->slug = $slug;
        return redirect()->back()->with($gender->save() ? 'success' : 'error',true);
    }
    public function settingsGendersAdd(Request $request){
        $languages = Language::all();
        $request->validate([
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $gender= new Gender();
        $slug = Str::slug($request->title_az);
        $old_gender = Gender::where('slug',$slug)->first();
        if($old_gender){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $gender->$title = $request->$title;
        }
        $gender->slug = $slug;
        return redirect()->back()->with($gender->save() ? 'success' : 'error',true);
    }
    public function settingsJobTypeIndex(){
        $jobtypes = JobType::orderBy('id','DESC')->get();
        $languages = Language::all();
        return view('back.settings.jobtype',compact('jobtypes','languages'));
    }
    public function jobtypeStatus(Request $request){
        $jobtype = JobType::find($request->id);
          
        if(!$jobtype){
          return '0';
      }
      $jobtype->status = $jobtype->status == '0' ? '1' : '0';
      return $jobtype->save() ? '1' : '0';
    }
    public function settingsJobTypeEdit(Request $request){
        $jobtype = JobType::find($request->id);
        return $jobtype ?? '0';
    }
    public function settingsJobTypePost(Request $request){
        $languages = Language::all();
        $request->validate([
            'id'=>'required',
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $jobtype= JobType::find($request->id);
        $slug = Str::slug($request->title_az);
        $old_jobtype = JobType::where([['slug',$slug],['id','<>',$jobtype->id]])->first();
        if($old_jobtype){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $jobtype->$title = $request->$title;
        }
        $jobtype->slug = $slug;
        return redirect()->back()->with($jobtype->save() ? 'success' : 'error',true);
    }
    public function settingsJobTypeAdd(Request $request){
        $languages = Language::all();
        $request->validate([
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $jobtype= new JobType();
        $slug = Str::slug($request->title_az);
        $old_jobtype = JobType::where('slug',$slug)->first();
        if($old_jobtype){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $jobtype->$title = $request->$title;
        }
        $jobtype->slug = $slug;
        return redirect()->back()->with($jobtype->save() ? 'success' : 'error',true);
    }
    public function settingsAcceptIndex(){
        $accepttypes = AcceptType::orderBy('id','DESC')->get();
        $languages = Language::all();
        return view('back.settings.accept',compact('accepttypes','languages'));
    }

    public function acceptStatus(Request $request){
        $accept = AcceptType::find($request->id);
          
        if(!$accept){
          return '0';
      }
      $accept->status = $accept->status == '0' ? '1' : '0';
      return $accept->save() ? '1' : '0';
    }
    public function settingsAcceptEdit(Request $request){
        $accepttype = AcceptType::find($request->id);
        return $accepttype ?? '0';
    }
    public function settingsAcceptPost(Request $request){
        $languages = Language::all();
        $request->validate([
            'id'=>'required',
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $accepttype= AcceptType::find($request->id);
        $slug = Str::slug($request->title_az);
        $old_accepttype = JobType::where([['slug',$slug],['id','<>',$accepttype->id]])->first();
        if($old_accepttype){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $accepttype->$title = $request->$title;
        }
        $accepttype->slug = $slug;
        return redirect()->back()->with($accepttype->save() ? 'success' : 'error',true);
    }
    public function settingsAcceptAdd(Request $request){
        $languages = Language::all();
        $request->validate([
            'title_az'=>'required',
            'title_en'=>'required',
            'title_ru'=>'required',
            'title_tr'=>'required',
        ]);
        $accepttype= new AcceptType();
        $slug = Str::slug($request->title_az);
        $old_accepttype = AcceptType::where('slug',$slug)->first();
        if($old_accepttype){
            $slug = $slug.'_'.rand(1000,9999);
        }
        foreach ($languages as $language){
            $title = 'title_'.$language->shortname;

            $accepttype->$title = $request->$title;
        }
        $accepttype->slug = $slug;
        return redirect()->back()->with($accepttype->save() ? 'success' : 'error',true);
    }
}

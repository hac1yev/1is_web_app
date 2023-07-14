<?php

namespace App\Http\Controllers\Back\UserPolicyController;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Policy;
use App\Models\PrivacyCom;
use App\Models\PrivacyPro;
use Illuminate\Http\Request;

class UserPolicyController extends Controller
{
    public function policyList(){
        $policies = Policy::all();
        return view('back.policy.policy',compact('policies'));
    }
    public function policyAddPost(Request $request){
       $request->validate([
           'content_az'=>'required', 
           'content_en'=>'required',
           'content_ru'=>'required',
           'content_tr'=>'required',
       ]);
       $policy = new Policy();
       $policy->content_az = $request->content_az;
       $policy->content_en = $request->content_en;
       $policy->content_ru = $request->content_ru;
       $policy->content_tr = $request->content_tr;
       return redirect()->back()->with($policy->save() ? 'success' : 'error',true);
    }
    public function policyEdit(Request $request){
        $policy = Policy::find($request->id);
        if(!$policy){
            return '0';
        }
        return $policy ?? '0';
    }
    public function policyEditPost(Request $request){
        $request->validate([
            'id'=>'required|numeric',
            'content_az'=>'required',
            'content_en'=>'required',
            'content_ru'=>'required',
            'content_tr'=>'required',
        ]);
       
        $policy = Policy::find($request->id);
        if(!$policy){
            return redirect()->back()->with('error',true);
        }
        $policy->content_az = $request->content_az;
        $policy->content_en = $request->content_en;
        $policy->content_ru = $request->content_ru;
        $policy->content_tr = $request->content_tr;
         
        return redirect()->back()->with($policy->save() ? 'success' : 'error',true);
    }
    public function policyStatus(Request $request){
        $policy = Policy::find($request->id);
        if(!$policy){
            return '0';
        }
        $policy->status = $policy->status == '1' ? '0' : '1';
        return $policy->save() ? '1' : '0';
    }
    public function policyDelete(Request $request){
        $policy = Policy::find($request->id);
        if(!$policy){
            return '0';
        }
        return $policy->delete() ? '1' : '0';
    }
    public function privacyComList(){
        $pravicies = PrivacyCom::all();
        return view('back.policy.privacy_com',compact('pravicies'));
    }
    public function privacyComAddPost(Request $request){
        $request->validate([
            'content_az'=>'required',
            'content_en'=>'required',
            'content_ru'=>'required',
            'content_tr'=>'required',
        ]);
        $privacy = new PrivacyCom();
        $privacy->content_az = $request->content_az;
        $privacy->content_en = $request->content_en;
        $privacy->content_ru = $request->content_ru;
        $privacy->content_tr = $request->content_tr;
        return redirect()->back()->with($privacy->save() ? 'success' : 'error',true);
    }
    public function privacyComEdit(Request $request){
        $privacy = PrivacyCom::find($request->id);
        if(!$privacy){
            return '0';
        }
        return $privacy ?? '0';
    }
    public function privacyComEditPost(Request $request){
        $request->validate([
            'id'=>'required|numeric',
            'content_az'=>'required',
            'content_en'=>'required',
            'content_ru'=>'required',
            'content_tr'=>'required',
        ]);
        $privacy = PrivacyCom::find($request->id);
        if(!$privacy){
            return redirect()->back()->with('error',true);
        }
        $privacy->content_az = $request->content_az;
        $privacy->content_en = $request->content_en;
        $privacy->content_ru = $request->content_ru;
        $privacy->content_tr = $request->content_tr;
        return redirect()->back()->with($privacy->save() ? 'success' : 'error',true);
    }
    public function privacyComStatus(Request $request){
        $privacy = PrivacyCom::find($request->id);
        if(!$privacy){
            return '0';
        }
        $privacy->status = $privacy->status == '1' ? '0' : '1';
        return $privacy->save() ? '1' : '0';
    }
    public function privacyComDelete(Request $request){
        $privacy = PrivacyCom::find($request->id);
        if(!$privacy){
            return '0';
        }
        return $privacy->delete() ? '1' : '0';
    }
    public function privacyProList(){
        $pravicies = PrivacyPro::all();
        return view('back.policy.privacy_pro',compact('pravicies'));
    }
    public function privacyProAddPost(Request $request){
        $request->validate([
            'content_az'=>'required',
            'content_en'=>'required',
            'content_ru'=>'required',
            'content_tr'=>'required',
        ]);
        $privacy = new PrivacyPro();
        $privacy->content_az = $request->content_az;
        $privacy->content_en = $request->content_en;
        $privacy->content_ru = $request->content_ru;
        $privacy->content_tr = $request->content_tr;
        return redirect()->back()->with($privacy->save() ? 'success' : 'error',true);
    }
    public function privacyProEdit(Request $request){
        $privacy = PrivacyPro::find($request->id);
        if(!$privacy){
            return '0';
        }
        return $privacy ?? '0';
    }
    public function privacyProEditPost(Request $request){
        $request->validate([
            'id'=>'required|numeric',
            'content_az'=>'required',
            'content_en'=>'required',
            'content_ru'=>'required',
            'content_tr'=>'required',
        ]);
        $privacy = PrivacyPro::find($request->id);
        if(!$privacy){
            return redirect()->back()->with('error',true);
        }
        $privacy->content_az = $request->content_az;
        $privacy->content_en = $request->content_en;
        $privacy->content_ru = $request->content_ru;
        $privacy->content_tr = $request->content_tr;
        return redirect()->back()->with($privacy->save() ? 'success' : 'error',true);
    }
    public function privacyProStatus(Request $request){
        $privacy = PrivacyPro::find($request->id);
        if(!$privacy){
            return '0';
        }
        $privacy->status = $privacy->status == '1' ? '0' : '1';
        return $privacy->save() ? '1' : '0';
    }
    public function privacyProDelete(Request $request){
        $privacy = PrivacyPro::find($request->id);
        if(!$privacy){
            return '0';
        }
        return $privacy->delete() ? '1' : '0';
    }
}

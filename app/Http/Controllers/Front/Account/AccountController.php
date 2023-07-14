<?php

namespace App\Http\Controllers\Front\Account;
use App\Models\User;
use App\Models\Cv;
use App\Models\Favorits;
use App\Models\Vacancies;
use App\Models\Newslatter;
use App\Models\Categories;
use App\Models\BannerImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Mail\SendNewsletterMail ;
use App\Mail\SendForgetMail ;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class AccountController extends Controller  
{ 
    public function login()
        {
        return view('front.Account.login');
    }
    
    
    public function register()
        {        
        $categories = Categories::all();

        return view('front.Account.register', get_defined_vars());
    }

    public function forget()
        {

        return view('front.Account.forget');
    }

    public function confirmpass()
        {
        return view('front.Account.confirmpass');
    }
    
    public function forget_post(Request $request)
        {
            $request->validate([
                'email' => 'required|email|max:255',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return redirect()->route('forget')->with('error', __('messages.melyox'));
            }

            $user->email_verification_code = Str::random(40);
            $user->save();

            $data = [
                'email_name' => '1is.az',
                'subject' => 'Şifrə yeniləmə',
                'text' => 'Şifrənizi yeniləmək üçün bu linkə tıklayın:',
                'link' => env('APP_URL') . '/reset-password/' . $user->email_verification_code,
            ];

            Mail::to($user->email)->send(new SendForgetMail($data));

            return redirect()->route('forget')->with('success', __('messages.sendpass'));
    }


    public function googlelogin()
        {
            return Socialite::driver('google')->redirect();



        }
    public function callback()
    {
        $user = Socialite::driver('google')->user();

        dd($user);

    }

    

    public function forget_verification(Request $request)
        {
            $verification = $request->verification;

            try {
                DB::beginTransaction();

                $user_verification = User::where('email_verification_code', $verification)->first();

                if ($user_verification && !$user_verification->status == NULL) {
                    $user_verification->email_verification_code = "";
                    $user_verification->status = 1;
                    $user_verification->save();

                    DB::commit();

                    return redirect()->route('confirmpass')->with('success', __('messages.passyaz'));
                }
                else {
                    return redirect()->route('login');
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }

            return redirect()->route('confirmpass');
    }

    public function confirm_post(Request $request)
        {
            $request->validate([
                'password' => 'required|min:8|confirmed',
            ]);

            try {
                DB::beginTransaction();

                $user = User::where('email', $request->email)->first();

                if ($user) {
                    $user->email_verification_code = "";
                    $user->password = bcrypt($request->password);
                    $user->save();

                    DB::commit();

                    return redirect()->route('login')->with('success', __('messages.parollogin'));
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }

            return redirect()->back()->with('error', __('messages.errorpasyeni'));
    }



    public function register_post(Request $request){
        
        $request->validate([
            'name' => 'max:255',
            'surname' => 'max:255',
            'email' => 'max:255',
            'password' => 'min:8',

        ]);
        if (User::where('email', $request->email)->first()) {
            return redirect()->route('register')->with('error', __('messages.emailvar'));
        }
        
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'cat_id' => json_encode($request->cat_id),
            'email_verification_code' => Str::random(40),
            'is_email_verified' => false, 


            
        ]);
        $data=[];
        $data['email_name']='1is.az';
        $data['subject']='Email verification';
        $data['text']='Emailniz tesdiqleyin';
        $data['link']=env('APP_URL').'/user-verification/'.$user->email_verification_code;
        $data['text']='Emailniz tesdiqleyin';        

        Mail::to($user->email)->send(new SendMail($data));
        $user->save();


        return redirect()->route('login')->with('warning', __('messages.emailyoxla'));
    }
    
    
    public function user_verification(Request $request)
        {
            $verification = $request->verification;

            try {
                DB::beginTransaction();

                $user_verification = User::where('email_verification_code', $verification)->first();

                if ($user_verification && $user_verification->status == NULL) {
                    
                    $user_verification->email_verification_code = "";
                    $user_verification->status = 1;
                    $user_verification->is_email_verified = true;

                    $user_verification->save();

                    DB::commit();

                    return redirect()->route('login')->with('success', __('messages.emailtesdiq'));
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }

            return redirect()->route('login');
    }

    

    
    public function login_post(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $login = $request->only('email', 'password');
        $user = User::where([['status','1'],['email',$request->email]])->first();
        if($user){
            if (Auth::attempt($login, $request->filled('remember')) ){
                $request->session()->regenerate();
                
                return redirect()->route('index');
            }else{
                return back()->with('error', __('messages.passyox'));
            }
        }
        else{
            return back()->with('error', __('messages.emailyox'));
        }


    }

    public function logout()
        {
        Auth::logout();
        return redirect()->route('index');
    }
    

    public function profile(){
        $banner = BannerImage::where('status','1')->get();

        $userId = auth()->user()->id;
        $vacancies = Vacancies::where('user_id', $userId)->get();
        $cvs = Cv::where('user_id', $userId)->get();
        if(auth()->check()){
            $likes = Favorits::whereUserId(auth()->user()->id)->get()->pluck('vacancy_id')->toArray();}
            else {
            $likes = [];
        }
        $favorits = User::join('favorits', 'favorits.user_id', '=', 'users.id')
        ->join('vacancies', 'favorits.vacancy_id', '=', 'vacancies.id')
        ->join('companies','companies.id','=','vacancies.company_id')
        ->join('categories','categories.id','=','vacancies.category_id')
        ->select('users.id as user_id','vacancies.id as vacancy_id','vacancies.position','vacancies.created_at','companies.id as company_id','companies.name','categories.id as category_id','categories.title_az')
        ->where('favorits.user_id', $userId)
        ->distinct('favorits.vacancy_id')
        ->get();

        return View('front.Account.profile', get_defined_vars());
    }

    public function updatePassword(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'newpass' => 'required',
            'connewpass' => 'required'
        ]);
    
        $user = User::where('email', $validatedData['email'])->first();

        if (Hash::check($validatedData['password'], $user->password)) {
            $newpass = $validatedData['newpass'];
            $connewpass = $validatedData['connewpass'];
        
            if (empty($validatedData['password']) || empty($newpass) || empty($connewpass)) {
                return redirect()->back()->with('error', __('messages.bosdoldur'));
            }
        
            if (strlen($newpass) < 8 || strlen($connewpass) < 8) {
                return redirect()->back()->with('error', __('messages.8simvol'));
            }
        
            if ($newpass !== $connewpass) {
                return redirect()->back()->with('error', __('messages.passeynideyil'));
            }
        
            $user->password = Hash::make($newpass);
            $user->save();
        
            return redirect()->back()->with('success', __('messages.sifreyeni'));
        }
        return redirect()->route('profile')->with('error', __('messages.hazirpass'));
    } 
    
    
    public function newslatter(Request $request)
        {
            $email = $request->input('email');

            $user = new Newslatter([
                'email' => $email,
            ]);  
            
            $data=[];
            $data['email_name']='1is.az';
            $data['subject']='Verification';
            $data['text']='Hörmətli istifadəçi,

            Bülletenimizə abunəliyiniz uğurla aktivləşdirildi.';        

            Mail::to($user->email)->send(new SendNewsletterMail($data));
            $user->save();

            return back()->with('success', __('messages.sucemail'));
    }


}
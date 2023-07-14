<?php

namespace App\Http\Controllers\Back\AuthController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function adminLogin(){
        return view('back.login');
    }
    public function adminLogin_post(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $login = $request->only(['email', 'password']);
$user = User::where('is_admin', '1')
            ->where('status', '1')
            ->where('email', $request->email)
            ->first();
        if ($user){
            if (Auth::attempt($login)){
                // dd($request->session());
                $request->session()->regenerate();
                return redirect()->route('adminIndex');
            }else{
                return redirect()->back()->withInput()->with('password',true);
            }
        }else{
            return redirect()->back()->withInput()->with('non_user',true);
        }
    }
    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('adminLogout');
    }
}

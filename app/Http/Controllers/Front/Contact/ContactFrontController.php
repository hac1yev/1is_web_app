<?php

namespace App\Http\Controllers\Front\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendContactMail;
use App\Mail\SendButaMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use App\Models\ContactInfo;
use App\Models\BannerImage;

use DB;

class ContactFrontController extends Controller
{ 
    public function index(){ 
        $banner = BannerImage::where('status','1')->get();

        $contact = ContactInfo::first();
        return View('front.Contact.contact', get_defined_vars());
    }

    public function contactpost(Request $request){
        try {
            $request->validate([
                'name'=>'required',
                'surname'=>'required',
                'email'=>'required|email',                
                'phone' => 'required|numeric',
                'message'=>'required'

            ]);

            $contact = new Contact();            
            $contact->name = $request->name;
            $contact->surname = $request->surname;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->status = '0';            
    

            $data=[];
            $data['email_name']='1is.az';
            $data['subject']='Müraciət';
            $data['text']='Hörmətli istifadəçi,
        
            Müraciətiniz uğurla göndərildi'; 
            
            $datam=[];
            $datam['email_name']='1is.az';
            $datam['subject']='Müraciət';
            $datam['text']='Sizə email var'; 
            

            Mail::to('ulduz20022304@gmail.com')->send(new SendButaMail($datam));

            Mail::to($contact->email)->send(new SendContactMail($data));
            $contact->save();
    
            return redirect()->route('contactindex')->with('success',  __('messages.murgonder'));
    
        } catch (\Throwable $e) {
            return redirect()->route('contactindex')->with('error',$e->getMessage());
        }
    }
}

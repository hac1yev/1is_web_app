<?php

namespace App\Http\Controllers\Back\ContactInfoController;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use App\Models\Language;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function settingsContactIndex(){
        $data = ContactInfo::first();
        return view('back.settings.contact_info',compact('data'));
    }
    public function settingsContactPost(Request $request){
       $languages = Language::all();
       $request->validate([
           'email'=>'required|email',
           'phone'=>'required|min:10|max:19',
       ]);
       foreach ($languages as $language){
           $request->validate([
              'address_' . $language->shortname => 'required'
           ]);
       }
       $contact = ContactInfo::first();
        foreach ($languages as $language){
            $address = 'address_' . $language->shortname;
            $contact->$address = $request->$address;
        }
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        return redirect()->back()->with($contact->save() ? 'success' : 'error',true);
    }
}

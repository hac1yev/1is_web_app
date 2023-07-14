<?php

namespace App\Http\Controllers\Back\ContactController;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactIndex(){
        $messages = Contact::all();
        return view('back.contact.list',compact('messages'));
    }
    public function contactGet(Request $request){
        $message = Contact::find($request->id);
        if(!$message){
            return response()->json('0');
        }
        $message->status = '1';
        $message->save();
        return $message ?? response()->json('0');
    }
    public function contactDelete(Request $request){
        $message = Contact::find($request->id);
        if(!$message){
            return response()->json('0');
        }
        return $message->delete() ? response()->json('1') : response()->json('0');
    }
}

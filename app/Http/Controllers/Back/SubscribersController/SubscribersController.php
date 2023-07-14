<?php

namespace App\Http\Controllers\Back\SubscribersController;

use App\Http\Controllers\Controller;
use App\Models\Newslatter;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function subscribersIndex(){
        $subscribers = Newslatter::all();
        return view('back.subscribers.subscribers',compact('subscribers'));
    }
    public function subscribersStatus(Request $request){
        $subs = Newslatter::find($request->id);
        if(!$subs){
            return response()->json('0');
        }
        $subs->status = $subs->status == '0' ? '1' : '0';
        return $subs->save() ? response()->json('1') : response()->json('0');
    }
    public function subscribersDelete(Request $request){
        $subs = Newslatter::find($request->id);
        if(!$subs){
            return response()->json('0');
        }
        return $subs->delete() ? response()->json('1') : response()->json('0');
    }
}

<?php

namespace App\Http\Controllers\Back\ReviewController;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function reviewIndex(){
        $reviews = Review::orderBy('created_at','DESC')->get();
        return view('back.review.list',compact('reviews'));
    }
    public function reviewEdit($id){
        $review = Review::find($id);
        if(!$review){
            return redirect()->route('reviewIndex')->with('error',true);
        }
        return view('back.review.edit',compact('review'));
    }
    public function reviewPost(Request $request){
        $request->validate([
            'id'=>'required',
            'message'=>'required',
            'status'=>'required'
        ]);
        $review = Review::find($request->id);
        if(!$review){
            return redirect()->route('reviewIndex')->with('error',true);
        }

        $review->message = $request->message;
        $review->status = $request->status;
        return redirect()->route('reviewEdit',$review->id)->with($review->save() ? 'success' : 'error',true);
    }
    public function reviewStatus(Request $request){
        $review = Review::find($request->id);
          
        if(!$review){
          return '0';
      }
      $review->status = $review->status == '0' ? '1' : '0';
      return $review->save() ? '1' : '0';
    }
    public function reviewDelete(Request $request){
        $review = Review::find($request->id);
        if(!$review){
            return response()->json('0');
        }
       
        return $review->delete() ? response()->json('1') : response()->json('0');

    }
}

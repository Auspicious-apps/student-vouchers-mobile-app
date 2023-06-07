<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Arr;
use App\Rating;
use App\Voucher_aval;
class RatingController extends Controller
{   
    /* add like rating*/
    public function rating(Request $request)
    {
        
        $user_id = Auth::user()->id;
        
        $vid = $request->input('voucher_id');

        $exist = Rating::where('user_id',$user_id)->where('voucher_id',$vid)->count();
        Rating::where('user_id',$user_id)->where('voucher_id',$vid)->delete();
        $wishlist = new Rating;
        $wishlist->user_id = $user_id;
        $wishlist->voucher_id = $request->voucher_id;
        $wishlist->status =1;
        $wishlist->save();

        if($wishlist)
        {       
               
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Successfully Liked Product';
        }
        else
        {
            
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'Not Successfully Liked Product.';
            
        }
        
        return $data;
    }

    /*Add unlike rating*/
    public function unlike_rating(Request $request)
    {
        
        $user_id = Auth::user()->id;
        
        $vid = $request->input('voucher_id');

        $exist = Rating::where('user_id',$user_id)->where('voucher_id',$vid)->count();

        if($exist > 0)
        {       
            Rating::where('user_id',$user_id)->where('voucher_id',$vid)->update(['status'=>0]);
            
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Successfully Unliked Product';
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Not Successfully Unliked Product';
            
        }
        
        return $data;
    }

  
}

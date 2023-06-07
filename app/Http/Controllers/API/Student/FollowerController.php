<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Arr;
use App\Followers;
use App\Voucher_aval;
class FollowerController extends Controller
{   
    /* Add follow product api*/
    public function save_product(Request $request)
    {
        
        $user_id = Auth::user()->id;
        
        $vid = $request->input('voucher_id');

        $exist = Followers::where('user_id',$user_id)->where('voucher_id',$vid)->count();

        if($exist > 0)
        {       
            Followers::where('user_id',$user_id)->where('voucher_id',$vid)->delete();
            
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Product unfollowed successfully';
        }
        else
        {
            $wishlist = new Followers;
            $wishlist->user_id = $user_id;
            $wishlist->voucher_id = $request->voucher_id;
            $wishlist->save();
            
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Product followed successfully';
            
        }
        
        return $data;
    }
    
    /* fetch follow products*/
    public function get_saved_list(Request $request)
    {
        
        $user_id = Auth::user()->id;
        
        $result_data = [];
        
        $saved_data = Followers::where('user_id',$user_id)->get(['voucher_id']);
       
        for($i=0;$i<count($saved_data);$i++)
        {
            $saved_product = Voucher_aval::where('id',$saved_data[$i]->voucher_id)->get(['id','image','logo_image','brand','description','title']);

            $result_data[] = $saved_product;
        }

        $result = Arr::flatten($result_data);

       $item_count = count($result);
        
        if(sizeof($result) > 0)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Followed Products Fetched Successfully';
            $data['item_count']      =   $item_count;
            $data['data']      =         $result; 
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data found';
            $data['data']           =   [];  
        }
        
        return $data;
    }
}

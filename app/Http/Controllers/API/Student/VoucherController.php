<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Voucher_aval;
use App\Voucher_sold;
use App\Categories;
use App\Recent_view;
use Auth;

class VoucherController extends Controller
{
    /* Explore page api*/
    public function get_explore_vouchers(Request $request)
    {
        $result_data = [];

        $category_id = $request->category_id;

        $ids = explode(",", $category_id);

         // print_r($ids);
         // die;

        if($category_id==null){

                $result = Voucher_aval::get(['id','image','logo_image','description','title','brand','brand_url','vou_code','explore_index','category_id']);

                $result1 = Categories::where('parent_key',0)->get(['id','image']);
        
                $result_data['vouchers'] = $result;
                
                $result_data['categories'] = $result1;

                if(sizeof($result_data) > 0)
                {
                        $data['status_code']    =   1;
                        $data['status_text']    =   'Success';             
                        $data['message']        =   'Explore List Fetched Successfully';
                        $data['data']      =         $result_data; 
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
        else
        {

                // $result = Voucher_aval::where('category_id',$category_id)->get(['id','image','logo_image','description','title','brand','explore_index']);
               //$result = [];
               
                  $results = Voucher_aval::whereIn('category_id',$ids)->OrderBy('explore_index','ASC')->get(['id','image','logo_image','description','title','brand','brand_url','vou_code','explore_index','category_id']);
                 

                //}

                $result1 = Categories::where('parent_key',0)->get(['id','image']);
                
                $result_data['vouchers'] = $results;
                
                $result_data['categories'] = $result1;
                
                if(sizeof($result_data) > 0)
            	{
            		$data['status_code']    =   1;
                    $data['status_text']    =   'Success';             
                    $data['message']        =   'Explore List Fetched Successfully';
                    $data['data']      =         $result_data; 
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
    
    /* show voucher details*/
    public function get_voucher_details($id)
    {
        $details = Voucher_aval::where('id',$id)->get(['id','image','logo_image','title','description','terms_conditions','vou_code','brand_url']);            
    
    	if(sizeof($details) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Voucher details fetched successfully';
            $data['data']      =         $details;  
        }
    	else
    	{
    		$data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Detail Found';
            $data['data']           =   [];  
    	}
    	
        return $data;
    }

    /*Add recent item*/
    public function add_recent_item(Request $request)
    {
         $id = Auth::user()->id;

         $voucher_id = $request->voucher_id;

         $details = Voucher_aval::where('id',$voucher_id)->get(['id','image','logo_image','title','description','terms_conditions','vou_code','brand_url']); 
            
        $voucher_data = Recent_view::where('voucher_id',$details[0]->id)
                                 ->where('user_id',$id)->get(['id']);

        if(sizeof($voucher_data)){
                                        

            Recent_view::find($voucher_data[0]->id)->delete();

            $recently_view = new Recent_view;
     
            $recently_view->voucher_id =  $voucher_id;

            $recently_view->user_id = $id;
                             
            $recently_view->save();

        }
        else{
                         
            $recently_view = new Recent_view;
     
            $recently_view->voucher_id =  $voucher_id;

            $recently_view->user_id = $id;
                             
            $recently_view->save();

        }

        if(sizeof($details) > 0)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Recent item add successfully';
            $data['data']      =         $details;  
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Detail Found';
            $data['data']           =   [];  
        }
        
        return $data;
    }
    
    /*Delete recent item*/
    public function delete_recent_items(Request $request)
    {   
        $id = Auth::user()->id;

        $voucher_id = $request->voucher_id;

        $user = Recent_view::Where('user_id',$id)->where('voucher_id',$voucher_id)->delete();
        
        if($voucher_id)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Item removed successfully from recent view!'; 
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Detail Found'; 
        }
         return $data;
        
    }
    
}

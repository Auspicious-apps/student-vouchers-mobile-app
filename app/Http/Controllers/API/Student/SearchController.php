<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Recent_view;
use App\Voucher_aval;
use App\Categories;
use DB;
use Carbon\Carbon;
use Auth;

class SearchController extends Controller
{   
	/* Search page api*/
    public function default_search_page()
    {
        	
       $id = Auth::user()->id;
        	     
       $voucher_ids = Recent_view::where('user_id',$id)->get(['voucher_id']);
   
		 $view = [];

		for($i=0;$i<count($voucher_ids);$i++)
		{
			$recently_view = Voucher_aval::where('id',$voucher_ids[$i]->voucher_id)->get(['id','image','logo_image','brand','brand_url','vou_code','description','title']);

			$view[] = $recently_view;
		}

		$recently_viewed_vouchers = Arr::flatten($view);
		
		$categories = DB::table('categories')->where('parent_key',0)->get(['id','name']);
		
		
		$result_array = [];
		
		$result_array['recently_view'] = $recently_viewed_vouchers;
		$result_array['categories'] = $categories;
		
		if(sizeof($result_array) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Search Page Fetched Successfully';
            $data['data']      =         $result_array; 
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
    
    /* Search result api*/
    public function get_search_result(Request $request)
    {
        
        $query = $request->input('query');

      	$search_result = new Voucher_aval;


      	if(isset($query) && $query != null && $query != '')
      	{

      		$category_count = Categories::where('name','LIKE', '%'. $query . '%')->count();
      		
	      	if($category_count > 0 )
	      	{

	      		$category_ids = Categories::where('name','LIKE', '%'. $query . '%')->get(['id']);

	      		$category_id = $category_ids[0]->id;


	      		$search_result = Voucher_aval::where('category_id', $category_id)->orWhere('subcategories_id',$category_id)->get(['id','image','logo_image','description','title','brand','brand_url','vou_code','category_index']);


                
	      	}	
	      	else
	      	{
	      		
	      		$search_result = Voucher_aval::where('brand', 'LIKE', '%'. $query . '%' )->orWhere('title', 'LIKE', '%'. $query . '%')->get(['id','image','logo_image','description','title','brand','brand_url','vou_code','category_index']);
	      	}
	      	
	      	

	      	if(sizeof($search_result) > 0)
	    	{
	    		$data['status_code']    =   1;
	            $data['status_text']    =   'Success';             
	            $data['message']        =   'Search Results Fetched Successfully';
	            $data['data']      =         $search_result;  
	           
	        }
	    	else
	    	{
	    		$data['status_code']    =   0;
	            $data['status_text']    =   'Failed';             
	            $data['message']        =   'No Data Found';
	            $data['data']           =   [];  
	    	}


	    }
	    else
	    {
     		$data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'Please provide the search query.';
            $data['data']           =   [];  	    	
	    }
	    
        return $data;
        
    }
    
}

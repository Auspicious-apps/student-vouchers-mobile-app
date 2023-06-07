<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Whislist;
use App\Models\Voucher_aval;
use App\Models\Voucher_sold;
use App\Models\Recent_view; 
use App\Http\Controllers\API\Auth;
use Illuminate\Support\Arr;

class NewstudentController extends Controller
{
    public function coupon_category()
    {
    	$category = Categories::where('parent_key',0)->get();

    	if(sizeof($category) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Voucher Categories fetched successfully';
            $data['data']      =         $category;  
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

    public function available_voucher(Request $request)
    {
        $category_id = $request->input('category_id');


    	$avail_vouchers = Voucher_aval::where('category_id',$category_id)->get();

    	if(sizeof($avail_vouchers) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Available Vouchers fetched successfully';
            $data['data']      =         $avail_vouchers;  
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

    public function expire_voucher(Request $request)
    {
    	$voucher_id = $request->input('voucher_id');

    	$expire_vouchers = Voucher_sold::where('voucher_id',$voucher_id)->get();

    	if(sizeof($expire_vouchers) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Expired Vouchers fetched successfully';
            $data['data']      =         $expire_vouchers;  
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

    public function wishlist(Request $request)
    {
    	    	
    	$vid = $request->input('voucher_id');

    	$user_id = $request->input('user_id');

    	$exist = Whislist::where('user_id',$user_id)->where('voucher_id',$vid)->count();

    	// return $exist;

    	if($exist > 0)
    	{		
    		Whislist::where('user_id',$user_id)->where('voucher_id',$vid)->delete();
    	}
    	else{

    		$wishlist = new Whislist;
    		$wishlist->user_id = $request->user_id;
    		$wishlist->voucher_id = $request->voucher_id;
    		$wishlist->save();
    	}
    	if(sizeof($wishlist) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Voucher added to wishlist successfully';
            $data['data']      =         $wishlist;  
        }
    	else
    	{
    		$data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'Voucher removed from wishlist';
            $data['data']           =   [];  
    	}
        return $data;
    }

    public function display_voucher(Request $request)
    { 
    	$display_voucher = Voucher_aval::get(['image','logo_image','description','title','brand']);

    	if(sizeof($display_voucher) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Vouchers displayed successfully';
            $data['data']      =         $display_voucher;  
        }
    	else
    	{
    		$data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
    	}
        return $data;
    }

    public function show_particular_voucher(Request $request)
    {
        $id = $request->input('id');

    	$show_voucher = Voucher_aval::where('id',$id)->get();

    	$count = Recent_view::count();

    	if($count <= 4)
    	{
    		
    		$recently_view = new Recent_view;
 
      	    $recently_view->voucher_id = $request->id;
 
        	$recently_view->save();
    	}
    	else
    	{
    		
    		Recent_view::first()->delete();

    		$recently_view = new Recent_view;
 
      	    $recently_view->voucher_id = $request->id;
 
        	$recently_view->save();
    	}
    	

    	if(sizeof($show_voucher) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Voucher displayed successfully';
            $data['data']      =         $show_voucher;  
        }
    	else
    	{
    		$data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
    	}
        return $data;
    }

    public function searchapi(Request $request)
    {
      	$query = $request->input('query');

      	$vouchers = new Voucher_aval;


      	if(isset($query) && $query != null && $query != '')
      	{

      		$category_count = Categories::where('name','LIKE', '%'. $query . '%')->count();
      		
	      	if($category_count > 0 )
	      	{

	      		$category_ids = Categories::where('name','LIKE', '%'. $query . '%')->get(['id']);

	      		$category_id = $category_ids[0]->id;



	      		$vouchers = Voucher_aval::where('category_id', $category_id)->get();
	      	}	
	      	else
	      	{
	      		
	      		$vouchers = Voucher_aval::where('brand', 'LIKE', '%'. $query . '%' )->orWhere('title', 'LIKE', '%'. $query . '%')->get();
	      	}

	      	if(sizeof($vouchers) > 0)
	    	{
	    		$data['status_code']    =   1;
	            $data['status_text']    =   'Success';             
	            $data['message']        =   'Vouchers fetched successfully';
	            $data['data']      =         $vouchers;  
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

    public function recently_view(Request $request)
    {
    	
		$voucher_ids = Recent_view::get(['voucher_id']);

		 $view = [];

		for($i=0;$i<count($voucher_ids);$i++)
		{
			$recently_view = Voucher_aval::where('id',$voucher_ids[$i]->voucher_id)->get(['user_id','image','logo_image','brand','description','title']);

			$view[] = $recently_view;
		}

		$recent = Arr::flatten($view);
		
		if(sizeof($recent) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Recently viewed vouchers displayed';
            $data['data']      =         $recent;  
        }
    	else
    	{
    		$data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
    	}
        return $data;
    }

    public function sub_categories(Request $request)
    {
    	$id = $request->input('id');

    	$sub_categories = Categories::where('parent_key',$id)->get(['name']);

    	if(sizeof($sub_categories) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Voucher Subcategories fetched successfully';
            $data['data']      =         $sub_categories;  
        }
    	else
    	{
    		$data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
    	}
        return $data;
    }

    public function sub_cat_vouchers(Request $request)
    {
    	$id = $request->input('id');

    	$sub_id = Categories::where('id',$id)->get(['id']);

    	return $sub_id;

    	$sub_vouchers = Voucher_aval::where('subcategories',$sub_id)->get(['image','logo_image','description','title','brand']);
    	return $sub_vouchers;





    	
    }
}
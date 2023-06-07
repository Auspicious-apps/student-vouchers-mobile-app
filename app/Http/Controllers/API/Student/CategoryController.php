<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Voucher_aval;
use App\Categories;
use DB;


class CategoryController extends Controller
{   
    /* Fetch categories api*/
    public function list_categories()
    {
        
        $result = DB::table('categories')->where('parent_key',0)->get(['id','name']);
        
        if(sizeof($result) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Categories List Fetched Successfully';
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
    
    /* Fetch category detail with voucher and subcategories api*/
    public function get_category_detail($id)
    {
        
        $category = Categories::where('id',$id)->get(['name']);
        
        $category_title = $category[0]->name;
        
        $subcategories = DB::table('categories')->where('parent_key',$id)->get(['id','name']);
        
        $vouchers = Voucher_aval::where('category_id',$id)->orderBy('category_index','ASC')->get(['id','image','logo_image','description','title','brand','brand_url','vou_code','category_index']);
        
        $discount_count = count($vouchers);
        
        $result_data = [];
        
        $result_data['subcategories'] = $subcategories;
        $result_data['vouchers'] = $vouchers;
        
        if(sizeof($result_data) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Categories Details Fetched Successfully';
            $data['title']      =         $category_title; 
            $data['discount_count']      =         $discount_count; 
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
    
    /*Fetch subcategory detail api*/
    public function get_subcategory_detail(Request $request)
    {
         $category_id = $request->subcategory_id;

         $ids = explode(",", $category_id);

        $result = Voucher_aval::whereIn('subcategories_id',$ids)->orderBy('category_index','ASC')->get(['id','image','logo_image','description','title','brand','brand_url','vou_code','category_index']);
        
        if(sizeof($result) > 0)
    	{
    		$data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Subcategory Details Fetched Successfully';
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

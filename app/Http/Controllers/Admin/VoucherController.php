<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;
use App\Voucher_aval;
use App\User;
use App\Voucher_sold;
use \Illuminate\Support\Str;
use DB;
use File;
class VoucherController extends Controller
{

    //add discount voucher function
    public function index()
    {   
          $category= Categories::where('parent_key','0')->get();
          $vendor= User::where('user_type','3')->where('status',1)->get(['*']);
        
        return view('admin.add-discount-voucher',compact('category','vendor'));
    }


    // store voucher function
    public function addvoucher(Request $request)
    {    
       
        $voucher_aval = new Voucher_aval;
        $voucher_aval->user_id = $request->vendor_id;
        $voucher_aval->category_id = $request->category_id;
        $voucher_aval->title = $request->title;
        $voucher_aval->description = $request->description;
        $voucher_aval->vou_quantity = $request->vou_quantity;
        $voucher_aval->vou_value = $request->vou_value;
        if($request->orderDiscountPercent){
        $voucher_aval->offer_type = "percentage";
        $voucher_aval->amount = $request->orderDiscountPercent;
        }elseif($request->orderDiscountFixed){
        $voucher_aval->offer_type = "fixed";
        $voucher_aval->amount = $request->orderDiscountFixed;
        }
        $voucher_aval->start_date = $request->start_date;
        $voucher_aval->end_date = $request->end_date;
        $voucher_aval->brand = $request->brand;
        $voucher_aval->brand_url = $request->brand_url;
        $voucher_aval->vou_code = $request->vou_code;
       if($request->hasfile('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = 'image'.time().'.'.$extention;
            $file->move('category',$filename);
            $voucher_aval->image = $filename;
        }
        
         if($request->is_explore){
           
            $voucher_aval->is_explore = $request->is_explore;
         }else{
            $voucher_aval->is_explore = null;
         }
         $voucher_aval->category_index = $request->category_index;
         $voucher_aval->explore_index = $request->explore_index;
         $voucher_aval->subcategories_id = $request->subcategories_id;
         $voucher_aval->terms_conditions = $request->terms_conditions;

         if($request->hasfile('logo_image')){
            $lfile = $request->file('logo_image');
            $extention = $lfile->getClientOriginalExtension();
            $lfilename = time().'.'.$extention;
            $lfile->move('category',$lfilename);
            $voucher_aval->logo_image = $lfilename;
        }
      
        $voucher_aval->save();
       // dd($request->all());
       return redirect()->back()->with('status','Voucher Added Successfully');
    }


    //show discount voucher list
    public function show()
    {      
        $voucher_aval=  DB::table('voucher_avals')
          ->join('users', 'users.id', '=', 'voucher_avals.user_id')
          ->join('categories', 'categories.id', '=', 'voucher_avals.category_id')
        //  ->where('voucher_avals.id', '=', 2)
          ->select(['voucher_avals.id','voucher_avals.category_id','voucher_avals.user_id','users.first_name','users.last_name','voucher_avals.title','categories.name','voucher_avals.start_date','voucher_avals.end_date','voucher_avals.offer_type'])
          ->get();
      //dd($voucher_aval);
      return view('admin.discountvoucherlist',compact('voucher_aval'));
  }


    // show discount voucher profile 
     public function view($id)
    {
      $voucher_aval = DB::table('users')
              ->join('user_metas','users.id','=','user_metas.user_id')
            ->join('voucher_avals', 'users.id', '=', 'voucher_avals.user_id')
            ->join('categories', 'voucher_avals.category_id', '=', 'categories.id')
            ->select(['voucher_avals.id','voucher_avals.category_id','voucher_avals.user_id','users.first_name','users.last_name','voucher_avals.title','user_metas.image','categories.name','voucher_avals.description','voucher_avals.vou_quantity','voucher_avals.vou_value','voucher_avals.amount','voucher_avals.start_date','voucher_avals.end_date','voucher_avals.brand_url','voucher_avals.vou_code','voucher_avals.image','voucher_avals.offer_type'])
            ->where('voucher_avals.id','=',$id)
            ->get();
      //dd($voucher_aval[0]->image);
           //  $url = 'voucher-view/' . $id;
             //return redirect('voucher-view/'.$id);
      return view('admin.voucher-view',compact('voucher_aval'));
    }


    //edit voucher 
    public function editvoucher($id)
    {
       $category= Categories::where('parent_key','0')->get();

       $vendor= User::where('user_type','3')->where('status',1)->get(['*']);
       $voucher_aval = DB::table('users')
            ->join('user_metas','users.id','=','user_metas.user_id')
            ->join('voucher_avals', 'users.id', '=', 'voucher_avals.user_id')
            ->join('categories', 'voucher_avals.category_id', '=', 'categories.id')
            ->select(['voucher_avals.id','voucher_avals.category_id','voucher_avals.user_id','users.first_name','users.last_name','voucher_avals.title','user_metas.image','categories.name','voucher_avals.description','voucher_avals.vou_quantity','voucher_avals.vou_value','voucher_avals.amount','voucher_avals.start_date','voucher_avals.end_date','voucher_avals.brand_url','voucher_avals.vou_code','voucher_avals.image','voucher_avals.amount','voucher_avals.offer_type','voucher_avals.brand','voucher_avals.logo_image','voucher_avals.category_index','voucher_avals.explore_index','voucher_avals.terms_conditions','voucher_avals.subcategories_id'])
            ->where('voucher_avals.id','=',$id)
            ->get();

             $subcategory= Categories::where('id',$voucher_aval[0]->subcategories_id)->get();
     //  dd($subcategory);

        return view('admin.edit-discount-voucher',compact('voucher_aval','category','vendor','subcategory'));
    }


    //update voucher
    public function updatevoucher(Request $request, $id)
    {
      // die($request->subcategories);
        $voucher_aval = Voucher_aval::find($id);
        $voucher_aval->user_id = $request->vendor_id;
        $voucher_aval->category_id = $request->category_id;
        $voucher_aval->title = $request->title;
        $voucher_aval->description = $request->description;
        $voucher_aval->vou_quantity = $request->vou_quantity;
        $voucher_aval->vou_value = $request->vou_value;
        if($request->orderDiscountPercent){
        $voucher_aval->offer_type = "percentage";
        $voucher_aval->amount = $request->orderDiscountPercent;
        }elseif($request->orderDiscountFixed){
        $voucher_aval->offer_type = "fixed";
        $voucher_aval->amount = $request->orderDiscountFixed;
        }
        $voucher_aval->start_date = $request->start_date;
        $voucher_aval->end_date = $request->end_date;
        $voucher_aval->brand_url = $request->brand_url;
        $voucher_aval->vou_code = $request->vou_code;
       if($request->hasfile('image')){
            $destination = 'category/'.$voucher_aval->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            } 
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename =  'image'.time().'.'.$extention;
            $file->move('category/',$filename);
            $voucher_aval->image = $filename;
        }
        if($request->hasfile('logo_image')){
            $destination = 'category/'.$voucher_aval->logo_image;
            if(File::exists($destination))
            {
                File::delete($destination); 
            } 
            $file = $request->file('logo_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('category/',$filename);
            $voucher_aval->logo_image = $filename;
        }
          $voucher_aval->is_explore = $request->is_explore;
         $voucher_aval->category_index = $request->category_index;
         $voucher_aval->explore_index = $request->explore_index;
         $voucher_aval->subcategories_id = $request->subcategories_id;
         $voucher_aval->terms_conditions = $request->terms_conditions;
        $voucher_aval->update();
        return redirect()->back()->with('status','Voucher Updated Successfully');
    }


    // delete voucher  
     public function destroy($id)
    {
        $Voucher_aval= Voucher_aval::find($id);
        $destination = 'category/'.$Voucher_aval->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $Voucher_aval->delete();

        $destination = 'category/'.$Voucher_aval->logo_image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $Voucher_aval->delete();
        return redirect()->back()->with('status','Student Image Deleted Successfully');
    }
     public function subcategory(Request $request)
     {
       $id= $request->input('id');

       $ids = [];
       $names = [];
       $voucher_aval=[];

        $category= Categories::where('parent_key',$id)->get(['id','name']);

        for($i=0;$i<count($category);$i++){
            array_push($ids,$category[$i]->id);
            array_push($names,$category[$i]->name);
            
        }
      
        
          //print_r($voucher[0]->subcategories_id);
       return response()->json(['success'=>true,'subcategory'=>$names,'ids'=>$ids,'voucher_aval'=>$voucher_aval]);

     }

     public function sold()
     {

        $vouchersolds = Voucher_sold::all();
        return view('admin.voucher-sold',compact('vouchersolds'));
     }

}

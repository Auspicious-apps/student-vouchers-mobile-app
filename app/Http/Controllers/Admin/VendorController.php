<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\User_meta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{

    // Register Vendor
    public function index()
    {
          $vendors =    User::join('user_metas','users.id','=','user_metas.user_id')
           ->select('*')
            ->where(['user_type' => '3'])->where('status','0')
            ->get();

          return view('admin.vendorregistration',compact('vendors'));
    }


    // Approved vendors 
    public function approvevendor(Request $request)
    {
         $vendors =    User::join('user_metas','users.id','=','user_metas.user_id')
           ->select(['users.id','users.email','user_metas.phone','users.first_name','users.last_name','users.password','user_metas.amount','users.is_blocked'])
            ->where(['user_type' => '3'])->where('status','1')
            ->get();
          return view('admin.vendorlist',compact('vendors'));
    }


    // Approve Vendor function
    public function approved($id)
    {
        $vendors = User::where('id',$id)->where('user_type','3')->update(['status'=>'1']);         
        return redirect()->back();
    }
   
   public function blocked($id)
    {
        $vendors = User::where('id',$id)->where('user_type','3')->update(['is_blocked'=>'1']);         
        return redirect()->back();
    }


    // Reject Vendor function
    public function reject($id)
    {
        $vendors = User::where('id',$id)->where('user_type','3')->update(['status'=>'2']);
        return redirect()->back();
    }


    // store vendor function
    public function addvendor(Request $request)
    {    
         $pasword = Hash::make($request->password);
         $vendor = new User;
         $vendor->first_name = $request->first_name;
         $vendor->last_name = $request->last_name;
         $vendor->email = $request->email;
         $vendor->user_type = '3';
         $vendor->password = $pasword ;
         $vendor->plane_password = $request->password;            
         $vendor->status='1';
         $vendor->save();

         $vendor_meta = new User_meta;
         $vendor_meta->user_id = $vendor->id;
         $vendor_meta->amount = $request->amount;
         $vendor_meta->phone = $request->phone;
         $vendor_meta->save();

          return redirect()->back()->with('status','Vendor Added Successfully');
    }


    // edit Vendor 
    public function editvendor($id)
    {
        $vendor =    User::join('user_metas','users.id','=','user_metas.user_id')
        // ->select('*')
        // ->where(['user_type' => '3'])
         ->select(['users.id','users.email','user_metas.phone','users.first_name','users.last_name','users.plane_password','user_metas.amount'])
            ->where(['user_type' => '3'])->where('status','1')
        ->get()->find($id);
        return view('admin.edit-vendor',compact('vendor'));
    }


    // update Vendor
    public function updatevendor(Request $request, $id)
    {
       $pasword = Hash::make($request->password);
       $vendor =  User::find($id);
       $vendor->first_name = $request->first_name;
       $vendor->last_name = $request->last_name;
       $vendor->password = $pasword ;
       $vendor->plane_password = $request->password;
      
       $vendor->update();

          $vendor_meta = User_meta::where('user_id',$id)->update(['amount'=>$request->amount,'phone'=>$request->phone]);
         

      return redirect()->back()->with('status','Vendor updated Successfully');
    }


    // delete Vendor
    public function destroy($id)
    {
        $vendor= User::find($id);
        $vendor->delete();
        $vendor_meta = User_meta::where('user_id',$id)->delete();
       

        return redirect()->back()->with('status','Vendor Deleted Successfully');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\User_meta;
use App\Categories;
use Hash;
use App\Voucher_aval;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;
class AdminController extends Controller
{
     public function index()
    {   
         $students = User::where(['user_type' => '2'])->where('status','1')
        ->count();

         $vendors =  User::where(['user_type' => '3'])->where('status','1')
        ->count();

          $vouchers =  Voucher_aval::count();
        return view('admin.dashboard',compact('students','vendors','vouchers'));
    }

    public function index2()
    {
        return view('admin.add-category');
    }

    public function index3()
    {
        return view('admin.add-discount-voucher');
    }

    public function index4()
    {
        return view('admin.add-vendor');
    }

    public function index5()
    {
        return view('admin.voucher-view');
    }

     public function index6()
    {
        return view('admin.vendorlist');
    }
     public function index7()
    {
        return view('admin.studentlist');
    }
      public function index8()
    {
        return view('admin.studentregistration');
    }
    //   public function index9()
    // {
    //     return view('admin.category');
    // }
      public function index10()
    {
        return view('admin.edit-discount-voucher');
    }
      public function index11()
    {
        return view('admin.discountvoucherlist');
    }
      public function index12()
    {
        return view('admin.edit-vendor');
    }
      public function index13()
    {
        return view('admin.edit-category');
    }
       public function index14()
    {
        return view('admin.vendorregistration');
    }
     public function forgot(Request $request)
    {
       // $tokenData = DB::table('password_resets')->first();
        $user = DB::select('select * from password_resets ');
   
         if(empty($user)){
             
              return "Link Expire.";
             
         }else{
        $expire_date = date('Y-m-d H:i',strtotime('+60 minutes',strtotime($user[0]->created_at)));
        $now = date("Y-m-d H:i:s"); //current time


if ($now>$expire_date) { //if current time is greater then created time

   DB::table('password_resets')
    ->where('token', $user[0]->token)->delete();
    
    return "Link Expire.";
}
else  //still has a time
{
   return view('forgotpassword');
}
        //  DB::table('password_resets')->where();
    }    
    }
    public function reset_password(Request $request){
        
        $new_password = $request->password;

        $confirm_password = $request->password_confirmation;

        $email = $request->email;

        $user_id = User::where('email',$request->email)->get(['id']);
        
         if(sizeof($user_id))
        {
            if($new_password == $confirm_password)
            {
        
                    //$user = Auth::user();
                    $password = Hash::make($request->new_password);
                   
                    $user = User::where('email',$email)->update(['password'=>$password,'plane_password'=>$new_password]);
                    
                     return redirect()->back()->with(['message'=>'Password successfully changed!']);
            }
            else
            {
            
                  return redirect()->back()->with(['message'=>'Password not match']);
            }

        }
        else
        {

            return redirect()->back()->with(['message'=>'Email not exist.']);
        }  
         
    
    }
   

}

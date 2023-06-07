<?php

namespace App\Http\Controllers\API\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Voucher_sold;
use App\User_meta;
use Auth;
use DB;
use Carbon\Carbon;

class VoucherController extends Controller
{

    /* add amount manually and after scan */

    public function addmanually(Request $request)
    {
        $user_id = Auth::user()->id;

        $voucher_id = $request->voucher_id;

        $student_id = $request->student_id;

        $amount = $request->amount;
        
        $student = User_meta::where('student_id',$student_id)->get(['user_id']);
        // print_r($student[0]->user_id);
        // die;
        $user_data =  Voucher_sold::where('user_id',$user_id)
                      ->where('voucher_id', $voucher_id)
                      ->where('student_id',$student[0]->user_id)
                      ->get(['id']);

        if(sizeof($user_data) > 0)
        {

            $vdata = Voucher_sold::find($user_data[0]->id)->delete();

            $addmanually = new Voucher_sold;

            $addmanually->user_id =$user_id;

            $addmanually->voucher_id = $voucher_id;

            $addmanually->student_id = $student[0]->user_id;

            $addmanually->amount =  $amount;

            $addmanually->save();
        }
        else{

            $addmanually = new Voucher_sold;

            $addmanually->user_id = $user_id;

            $addmanually->voucher_id = $voucher_id;

            $addmanually->student_id =  $student[0]->user_id;

            $addmanually->amount =  $amount;

            $addmanually->save();
        }
      
        if(sizeof($addmanually) > 0)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Voucher has been sold to student!';
            $data['data']      =         $addmanually; 
          
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No data Found.';
            $data['data']           =   [];  
        }
        
        return $data;

    }
    
    /*Fetch vouchers */

    public function voucherhistory()
    {   
        $user_id = Auth::user()->id;

        $user_data =  Voucher_sold::where('user_id',$user_id)->get();
 
        if(sizeof($user_data) > 0)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Sold Vouchers Fetched Successfully!';
            $data['data']      =         $user_data; 
          
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data found.';
            $data['data']           =   [];  
        }
        
        return $data;
    }
}

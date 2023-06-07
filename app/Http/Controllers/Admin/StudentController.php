<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\User_meta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use QrCode;
use App\Qrcodes;
use Illuminate\Support\Facades\File;
class StudentController extends Controller
{
  
   //show students to approve or reject
    public function index()
    {
   
      $students =    User::join('user_metas','users.id','=','user_metas.user_id')
       ->select('*')
        ->where(['user_type' => '2'])->where('status','0')->where('university_id_photo','!=',null)
        ->get();
      return view('admin.studentregistration',compact('students'));
    }


    //approved students list is here 
    public function approvestudent(Request $request)
    {
     $students =    User::join('user_metas','users.id','=','user_metas.user_id')
       ->select('*')
        ->where(['user_type' => '2'])->where('status','1')
        ->get();
      return view('admin.studentlist',compact('students'));
    }


  //approve students function
  public function approved($id)
  {
    $students = User::where('id',$id)->where('user_type','2')->update(['status'=>'1']);
    return redirect()->back();
  }
  public function blocked($id)
  {
    $students = User::where('id',$id)->where('user_type','2')->update(['is_blocked'=>'1']);
    return redirect()->back();
  }


  //reject students function
   public function reject($id)
  {
     $students = User::where('id',$id)->where('user_type','2')->update(['status'=>'2']);
    return redirect()->back();
  }
  public function qrcode()
  {
     //$students =    User_meta::where('user_id',$id)->get();
      $students =    User::join('user_metas','users.id','=','user_metas.user_id')
        ->where(['user_type' => '2'])->where('verified','1')->where('status','1')
        ->get(['user_metas.student_id','user_metas.university_email','user_metas.user_id','users.first_name','users.last_name']);
        //dd($students['items'] );
      $qr =  Qrcodes::all();
      for($j=0;$j<count($qr);$j++){
      $destination= 'qrcode/'.$qr[$j]->image;
      if(File::exists($destination))
        {
            File::delete($destination);
        }
      }
      Qrcodes::truncate();
      $new_values = [];
      for($i=0;$i<count($students);$i++){
      $path = 'qrcode/';
      $file_path = $path .'qrcode-'. $i . '.png';
      $image = \QrCode::format('png')
                 ->size(200)->errorCorrection('H')
                 ->generate($students[$i]->student_id.' , '.$students[$i]->university_email,$file_path);
        $qrdata = new Qrcodes;
        $qrdata->user_id = $students[$i]->user_id;
        $qrdata->student_id = $students[$i]->student_id;
        $qrdata->university_email = $students[$i]->university_email;
        $qrdata->image = str_replace($path, '', $file_path);
        $qrdata->save();
        array_push($new_values,$qrdata);
      }
       return view('admin.qr',compact('new_values'));
  }

}

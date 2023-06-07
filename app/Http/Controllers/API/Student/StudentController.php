<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\User;
use App\User_meta;
use App\User_otp;
use Validator;
use App\Mail\TestMail;
use App\Mail\ForgotMail;
use Hash;
use App\Language;
use App\Notification;
use App\Device_token;
use DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
class StudentController extends Controller
{    

     /* login api */

     public function login(Request $request) { 
        
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $language = $request->language;

        $dtoken = $request->token;

        $credentials = request(['email','password']);
          
        if(!Auth::attempt($credentials))
             return response()->json([
                'message' => 'Invalid credentials.'
        ], 401);
         // print_r($user[0]->id);
         
        $user = User::where('email',$request->email)->get(['status','verified','is_blocked','id']);
        if(!$user[0]->verified=='1')
        {
            return response()->json(['message' => 'Email not verified.','user_id'=>$user[0]->id], 453);
        }

        else  if($user[0]->status=='2')
        {
            return response()->json(['message' => 'User rejected by admin.'], 452);
        }

        else if(!$user[0]->is_blocked=='0')
        {
            return response()->json(['message' => 'User is blocked by admin.'], 454);
        }

        else if($user[0]->status=='0')
        {
            return response()->json(['message' => 'User approval pending from admin.'], 455);
        }

        $user = $request->user();
        
        $languages_data= Language::where('user_id',$user->id)->get(['id']);

        if(sizeof($languages_data))
        {
            Language::find($languages_data[0]->id)->delete();

            $languages = new Language;

            $languages->user_id = $user->id;

            $languages->language = $language;

            $languages->save();
            
        }else{
           
            $languages = new Language;

            $languages->user_id = $user->id;

            $languages->language = $language;

            $languages->save();
        }
        
        $tokenResult = $user->createToken('Personal Access Token');
    
        $token = $tokenResult->token;
        
        $device_token_data= Device_token::where('user_id',$user->id)->get(['id']);

        if(sizeof($device_token_data))
        {   
             $device_tokens= Device_token::where('user_id',$user->id)->update(['token'=>$dtoken]);
        }
        else{

        $device_token = new Device_token;

        $device_token->user_id = $user->id;

        $device_token->token = $dtoken;

        $device_token->save();
        }    
        $SERVER_API_KEY = "AAAAvonCXx4:APA91bH0wR-SqoB5OOt9asWARqNT5rqAau7YGmz_5IxJV6shTN0AWa9IaLSdJxl5B872GkqGlKgRCQWQIRgXorVL8kTUBUm07QA4K26Z8HL1pn-oEpvJLnvhANfuSdFUMxFJm3qWwKq1";
           
        $notification_data = [
                "to" => $dtoken,
                    "notification" => [
                          "icon"=>"http://student-vouchers.auspicioussoft.com/public/images/icon.png",
                        "title" => "Uniplusco",
                        "body" => "Welcome to uniplusco!",
                        "content_available" => true,
                        "priority" => "high",
                    ]
            ];
               
        $dataString = json_encode($notification_data);
                   //die( $dataString);
        $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];
                
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
                 
        $data = json_decode($response);
        // print_r($data);
        // die;
        $file = "http://student-vouchers.auspicioussoft.com/public/images/icon.png";;
                    
        $notifications = new Notification;

        $notifications->user_id = $user->id;

        $notifications->subject = "Uniplusco";

        $notifications->message = "Welcome to uniplusco!";

        $notifications->image = "icon.png";

        $notifications->save();
      
          if ($request->remember_me)
            $token->expires_at = Carbon::now()->addHours(24);
            $token->save();
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
                'is_verified'=>$user->verified,
                'user_id'=>$user->id

            ]);


    }

    /*Register api and verify university email */ 

    public function signup(Request $request) 
    { 
           
            $validator = Validator::make($request->all(), [ 
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|string|unique:users',
                'address' => 'required',
                'city' => 'required',
                'phone' => 'required|string|min:10|max:10',
                'country' => 'required',
                'country_code' => 'required',
                'password' => 'required|string',
                'password_confirmation' => 'required|same:password',
                //'image' => 'required|mimes:jpeg,png,jpg,gif',
                // 'university_email' => 'required',
                // 'otp' => 'required'
            ]);
             //$firebaseToken=$request->device_token;

            // if($validator->fails()){
            //     return response()->json($validator->errors(), 401);

            // }
            
            if($validator->fails())
            {

                $errors = $validator->errors();
    
                $messages = [];
    
                foreach ($errors->all() as $message) 
                {
    
                    $messages[]  = $message;
                        
                }
    
                return response()->json(['message'=>$messages], 401);

            }

            else 
            {
                if($request->university_email){
                $optdata = User_otp::where('email',$request->university_email)->where('otp',$request->otp)->get();

                if(sizeof($optdata))
                {

                     $data =   array (
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'email' => $request->email,
                        'address' => $request->address,
                        'password' => bcrypt($request->password),
                        'plane_password'=>$request->password,
                        'user_type' => '2',
                        'status'=>'1',
                        'verified'=>'1'
                    
                    );
                 
                    $email = $request->email;

                    $user_data = DB::table('users')->insert($data);

                    $user = DB::select('select * from users where email = ?',[$email]);
                    
                    $stu_id = rand(1000,9999);

                    $student_id = 'ID'.$stu_id;
                    if($request->image){  
                    $file = $request->file('image');
                    
                    $extention = $file->getClientOriginalExtension();
                    
                    $filename = time().'.'.$extention;
                    
                    $file->move('category/', $filename);
                         
                    $values = array (
                        'user_id' => $user[0]->id,
                        'city' => $request->city,
                        'country' => $request->country,
                        'country_code' => $request->country_code,
                        'phone' => $request->phone,
                        'student_id' =>  $student_id,
                        'university_email'=>$request->university_email,
                        'image' => $filename,
                    );
                }else{
                    $values = array (
                        'user_id' => $user[0]->id,
                        'city' => $request->city,
                        'country' => $request->country,
                        'country_code' => $request->country_code,
                        'phone' => $request->phone,
                        'student_id' =>  $student_id,
                        'university_email'=>$request->university_email,
                        
                    );
                }

                    $user_meta = DB::table('user_metas')->insert($values);
                    
                     $credentials =['email'=>$user[0]->email,'password'=>$user[0]->plane_password];
          
                    if(!Auth::attempt($credentials))
                         return response()->json([
                            'message' => 'Invalid credentials.'
                    ], 401);
                    
                    $login_user = $request->user();
                    
                    $tokenResult = $login_user->createToken('Personal Access Token');
    
                    $token = $tokenResult->token;
        
                     return response()->json([
                        'access_token' => $tokenResult->accessToken,
                        'token_type' => 'Bearer',
                        'expires_at' => Carbon::parse(
                            $tokenResult->token->expires_at
                        )->toDateTimeString(),
                        'is_verified'=>$user[0]->verified,
                        'user_id'=>$user[0]->id
        
                    ]);

                    

                    //return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'User created successfully !','user_id'=>$user[0]->id,'access_token' => $tokenResult->accessToken]); 
                }

                else
                {

                    return response()->json(['status_code'=>0,'status_text'=> 'Success','message'=>'University Email not verified!']); 
                }
            }else{
                $data =   array (
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'email' => $request->email,
                        'address' => $request->address,
                        'password' => bcrypt($request->password),
                        'plane_password'=>$request->password,
                        'user_type' => '2',
                        'status'=>'0',
                        'verified'=>'1'
                    
                    );
                 
                    $email = $request->email;

                    $user_data = DB::table('users')->insert($data);

                    $user = DB::select('select * from users where email = ?',[$email]);
                    
                    $stu_id = rand(1000,9999);

                    $student_id = 'ID'.$stu_id;
                      if($request->image && $request->university_id_photo){       
                    $file = $request->file('image');
                    
                    $extention = $file->getClientOriginalExtension();
                    
                    $filename = time().'.'.$extention;
                    
                    $file->move('category/', $filename);
                    
                    $ufile = $request->file('university_id_photo');
                    
                    $uextention = $ufile->getClientOriginalExtension();
                    
                    $ufilename = 'uni'.time().'.'.$uextention;
                    
                    $ufile->move('category/', $ufilename);
                         
                    $values = array (
                        'user_id' => $user[0]->id,
                        'city' => $request->city,
                        'country' => $request->country,
                        'country_code' => $request->country_code,
                        'phone' => $request->phone,
                        'student_id' =>  $student_id,
                        'university_id_photo'=>$ufilename,
                        'image' => $filename,
                    );
                      }else if($request->university_id_photo){
                          
                    
                    $ufile = $request->file('university_id_photo');
                    
                    $uextention = $ufile->getClientOriginalExtension();
                    
                    $ufilename = 'uni'.time().'.'.$uextention;
                    
                    $ufile->move('category/', $ufilename);
                         
                    $values = array (
                        'user_id' => $user[0]->id,
                        'city' => $request->city,
                        'country' => $request->country,
                        'country_code' => $request->country_code,
                        'phone' => $request->phone,
                        'student_id' =>  $student_id,
                        'university_id_photo'=>$ufilename,
                        
                    );
                      }else if($request->image){
                          $file = $request->file('image');
                    
                    $extention = $file->getClientOriginalExtension();
                    
                    $filename = time().'.'.$extention;
                    
                    $file->move('category/', $filename);
                         
                    $values = array (
                        'user_id' => $user[0]->id,
                        'city' => $request->city,
                        'country' => $request->country,
                        'country_code' => $request->country_code,
                        'phone' => $request->phone,
                        'student_id' =>  $student_id,
                        'image' => $filename,
                    );
                      }else{
                        
                    $values = array (
                        'user_id' => $user[0]->id,
                        'city' => $request->city,
                        'country' => $request->country,
                        'country_code' => $request->country_code,
                        'phone' => $request->phone,
                        'student_id' =>  $student_id,
                        
                    );
                      }
                    $user_meta = DB::table('user_metas')->insert($values);
                    
                    //   $credentials =['email'=>$user[0]->email,'password'=>$user[0]->plane_password];
          
                    // if(!Auth::attempt($credentials))
                    //      return response()->json([
                    //         'message' => 'Invalid credentials.'
                    // ], 401);
                    
                    // $login_user = $request->user();
                    
                    // $tokenResult = $login_user->createToken('Personal Access Token');
    
                    // $token = $tokenResult->token;
        
                    //  return response()->json([
                    //     'access_token' => $tokenResult->accessToken,
                    //     'token_type' => 'Bearer',
                    //     'expires_at' => Carbon::parse(
                    //         $tokenResult->token->expires_at
                    //     )->toDateTimeString(),
                    //     'is_verified'=>$user[0]->verified,
                    //     'user_id'=>$user[0]->id
        
                    // ]);

                    return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'User created successfully !','user_id'=>$user[0]->id]); 
            }
            }
    }
    
    /* University email verfication send otp api */

    public function sendverificationcode(Request $request) 
    {   
        $email = $request->email;

        $data = $request->all();

        // $validator = Validator::make($request->all(), [          
        //   'email' => 'required|ends_with:@edu.eg',
        //     // 'email' => 'required|ends_with:.com',
        // ]);

        // if($validator->fails())
        // {
        //     return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Invalid University Email.']);

        // } 

        // else 
        // {
            $optdata = User_otp::where('email',$email)->get(); 
            
            // return sizeof($optdata);
    
            $otp = rand(100000,999999);
       
                if(sizeof($optdata))
                {
                    $user = User_otp::where('email','=',$request->email)->update(['otp' => $otp]);
                    
                     $details = [
                            'body'=>'your verification code',
                            'otp'=>$otp,
                            
                        ];
                     
                        \Mail::to($email)->send(new TestMail($details));
                    return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Otp sent on your mail!','otp'=>$otp]); 
                }

                else
                {

                    $user = User_otp::create([
                    // 'user_id'=>$user_id,
                    'email' => $email,
                    'otp' => $otp 
                    ]);

                    // $user = User::where('id',$user_id)->where('user_type','2')->update(['verified'=>'1']);

                    // $user_meta = User_meta::where('user_id',$user_id)->update(['university_email'=>$email]);
                    //dd($user_meta);

                     $details = [
                            'body'=>'your verification code',
                            'otp'=>$otp,
                            
                        ];
              
                        \Mail::to($email)->send(new TestMail($details));
       

                    return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Otp sent on your mail!','otp'=>$otp]);
                } 
      //  }
         
    }

     /* Forgot password send otp api*/

    public function forgotpasssword(Request $request) 
    { 
           $request->validate(['email' => 'required|ends_with:.com']);
 
            // $status = Password::sendResetLink(
            //     $request->only('email')
            // );
            
            $data = User::where('email',$request->email)->get(['id']); 
            
            $token = Str::random(64);
            
            if(sizeof($data))
            {
                
                    $details = [
                            'title'=>'Reset password',
                            'link'=>"http://student-vouchers.auspicioussoft.com/public/forgot",
                             //'token' =>  $token,
                            
                        ];
                        
                        
              
                        \Mail::to($request->email)->send(new ForgotMail($details));
                        
                        DB::table('password_resets')->delete();
                        
                        DB::table('password_resets')->insert([
                            'email' => $request->email,
                            'token' => $token,
                            'created_at' => Carbon::now()
                        ]);
        
        
                    return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Password reset link sent on your email']); 
            }
            else
            {
                   return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Email not exist.']);
            }
        // if(sizeof($user_id))
        // {
        //         $optdata = User_otp::where('email',$email)->where('user_id',$user_id[0]->id)->get(); 
            
        //         $otp = rand(100000,999999);
       
        //         if(sizeof($optdata))
        //         {
        //             $user = User_otp::where('email','=',$request->email)->where('user_id',$user_id[0]->id)->update(['otp' => $otp]);
                    
        //              $details = [
        //                     'body'=>'your verification code',
        //                     'otp'=>$otp,
                            
        //                 ];
                     
        //                 \Mail::to($email)->send(new TestMail($details));
        //              return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Otp sent on your mail!','otp'=>$otp]); 
        //         }
        //         else
        //         {

        //             $user = User_otp::create([
        //             'user_id'=>$user_id[0]->id,
        //             'email' => $email,
        //             'otp' => $otp 
        //             ]);
                    
        //              $details = [
        //                     'body'=>'your verification code',
        //                     'otp'=>$otp,
                            
        //                 ];
              
        //                 \Mail::to($email)->send(new TestMail($details));
       

        //             return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Otp sent on your mail!','otp'=>$otp]);
        //         } 
        //  }
        //  else
        //  {
        //      return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Email not exist.']);
        //   }
     }

    /* Forgot password verify otp api*/
   
    public function verifyotp(Request $request) 
    {   
       $data = $request->all();

       $otp = $request->otp;
      
       $user_id = User::where('email',$request->email)->get(['id']);

        if(sizeof($user_id))
        {
            $optdata = User_otp::where('user_id',$user_id[0]->id)->where('otp',$otp)->get();
          // die($optdata );
            if(sizeof($optdata))
            {
               
               return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Successfully verify otp']);
            }
            else
            {
               return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Invalid otp']);
            }

        }

        else
        {
            return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Email not exist.']);
        }    
           
    }
      /* Forgot password api*/

    public function change_password(Request $request) 
    {  
        $new_password = $request->new_password;

        $confirm_password = $request->confirm_password;

        $email = $request->email;

        $user_id = User::where('email',$request->email)->get(['id']);

        if(sizeof($user_id))
        {
            if($new_password == $confirm_password)
            {
        
                    //$user = Auth::user();
                    $password = Hash::make($request->new_password);
                   
                    $user = User::where('email',$email)->update(['password'=>$password,'plane_password'=>$new_password]);
                    
                     return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Password successfully changed!']);
            }
            else
            {
            
                  return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Password not match']);
            }

        }
        else
        {

            return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Email not exist.']);
        }    
    
    }
     /*logout to customer*/  

    public function logout(Request $request) 
    {
        // $user_id = Auth::user()->id;

        // $dtoken = $request->token;

        // $device_token_data= Device_token::where('user_id',$user_id)->where('token',$dtoken)->delete();

        $request->user()->token()->revoke();

        return response()->json([
                'message' => 'Successfully logged out'
            ]);
    }

   /* show details of users*/

    public function user(Request $request) {

        $id = Auth::user()->id;

        $user = User::join('user_metas','users.id','=','user_metas.user_id')
        ->select(['user_metas.user_id','users.first_name','users.last_name','users.email','users.address','user_metas.city','user_metas.country','user_metas.student_id','user_metas.university_email',
        'user_metas.university_id_photo'])
        ->where('user_type',2)->find($id);
       // return response()->json($user);

        if($user)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Student Data Fetched';
            $data['data']      =         $user;  
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
     

      /* change password send otp api*/
       
    public function verificationcode(Request $request) 
    {   
        $email = $request->email;

        $user_id =Auth::user()->id;

        $data = $request->all();

        $optdata = User_otp::where('email',$email)->where('user_id',$user_id)->get(); 
    
        $otp = rand(100000,999999);
       
                if(sizeof($optdata))
                {
                    $user = User_otp::where('email','=',$request->email)->where('user_id',$user_id)->update(['otp' => $otp]);
                    
                     $details = [
                            'body'=>'your verification code',
                            'otp'=>$otp,
                            
                        ];
                     
                        \Mail::to($email)->send(new TestMail($details));
                     return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Otp sent on your mail!','otp'=>$otp]); 
                }
                else{

                    $user = User_otp::create([
                    'user_id'=>$user_id,
                    'email' => $email,
                    'otp' => $otp 
                    ]);
                    
                     $details = [
                            'body'=>'your verification code',
                            'otp'=>$otp,
                            
                        ];
              
                        \Mail::to($email)->send(new TestMail($details));
       

                    return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Otp sent on your mail!','otp'=>$otp]);
                } 
    
         
    }

    /* Change password verifiy otp api*/

    public function verify_otp(Request $request) 
    {   
        $data = $request->all();

        $otp = $request->otp;

        $id =Auth::user()->id;
         
        $optdata = User_otp::where('user_id',$id)->where('otp',$otp)->get();
          // die($optdata );
        if(sizeof($optdata))
        {
               
            return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Successfully verify otp']);
        }
        else
        {
            return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Invalid otp']);
        }
    
           
    }
       /* change password after login */

    public function changepassword(Request $request) 
    {  
        $new_password = $request->new_password;

        $confirm_password = $request->confirm_password;

        if ((Hash::check($new_password , auth()->user()->password))) 
        {

            return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'New Password cannot be same as your current password!']); 
        }
        
        if($new_password == $confirm_password)
        {
        
            $user = Auth::user();
            $user->plane_password = $request->new_password;
            $user->password = Hash::make($request->new_password);
            $user->save();
            
             return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Password successfully changed!']);
        }else{
            
            return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Password not match']);
        }
    
    }
    
     
     /* Delete user api*/

    public function delete_user(Request $request)
    {   
        $id = Auth::user()->id;

        $user = User::Where('id',$id)->delete();

        return response()->json([
                    'message' => 'You have been successfully deleted your account!'
                ], 200); 
        
    }

    /* Edit profile api*/

    public function edituser(Request $request) {

        $id = Auth::user()->id;
        //die($request->city);
        $user = User::join('user_metas','users.id','=','user_metas.user_id')
                ->select(['user_metas.id','users.first_name','users.last_name','users.address','user_metas.city','user_metas.country','user_metas.image','user_metas.user_id'])
                ->where('user_type',2)->find($id);

        $first_name = $request->first_name;

        $last_name = $request->last_name;

        $address = $request->address;

        $city = $request->city;

        $country = $request->country;

        $image = $request->image;
       
  
        // $meta = User_meta::where('user_id',$id)->update([ 
        //                'city'=>$city,
        //                 'country'=>$country,
        //                    ]);
        // $user_data = User::where('id',$id)->update([ 'first_name' => $first_name,
        //         'last_name' => $last_name,'address'=>$address]);
             
        
        if($request->image)
        {
            $file = $request->file('image');

            $extention = $file->getClientOriginalExtension();

            $filename = time().'.'.$extention;

            $file->move('category/', $filename);

            $user_meta= User_meta::where('user_id',$id)->update([ 'image'=>$filename]);
        }

        if($request->city)
        {
            $user_meta= User_meta::where('user_id',$id)->update(['city'=>$city]);
        }

        else
        {
            $user_meta= User_meta::where('user_id',$id)->update(['city'=>$user->city]);
        }

        if($request->country)
        {
            $user_meta= User_meta::where('user_id',$id)->update(['country'=>$country]);
        }

        else
        {
            $user_meta= User_meta::where('user_id',$id)->update(['country'=>$user->country]);
        }

        if($request->first_name)
        {
            $user_meta= User::where('id',$id)->update([ 'first_name' => $first_name]);
        }

        else
        {
            $user_meta= User::where('id',$id)->update([ 'first_name' => $user->first_name]);
        }
          
        if($request->last_name)
        {
            $user_meta= User::where('id',$id)->update(['last_name' => $last_name]);
        }

        else
        {
            $user_meta= User::where('id',$id)->update(['last_name' => $user->last_name]);
        }
          
        if($request->address)
        {
            $user_meta= User::where('id',$id)->update(['address'=>$address]);
        }

        else
        {
            $user_meta= User::where('id',$id)->update(['address'=>$user->address]);
        }

        if($user)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Profile Updated Successfully';
            $data['data']      =         $user;  
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'Profile Not Updated !';
            $data['data']           =    [];  
        }
        return $data;
    }
   
   public function notifications(Request $request)
   {
       $user_id = Auth::user()->id;

       $device_token = Device_token::where('user_id',$user_id)->get(['user_id']);
        
       $notifications = []; 

       for($i=0;$i<count($device_token);$i++){

       $notification = Notification::where('user_id',$device_token[$i]->user_id)->where('read_status','0')->orderBy('id','DESC')->get(['id','subject','message','image']);

          $notifications[] = $notification;

        }

        if($notifications)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Notifications Fetched Successfully';
            $data['data']      =         $notifications[0];  
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Not Updated !';
            $data['data']           =    [];  
        }
        return $data;
                
   }

   public function delnotifications(Request $request)
   {
       $id = Auth::user()->id;

        $notification_id = $request->notification_id;

        $user = Notification::Where('user_id',$id)->where('id',$notification_id)->update(['read_status'=>1]);
        
        if($notification_id)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Notification removed successfully!'; 
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Detail Found'; 
        }
         return $data; 
                
   }

   public function firebase_refresh_token(Request $request)
   {
        $id = Auth::user()->id;  

        $token = $request->token;

        $device_tokens= Device_token::where('user_id',$id)->update(['token'=>$token]);
        
        if($device_tokens)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Token refresh successfully!'; 
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

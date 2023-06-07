<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\User_meta;
use Auth;
use Socialite;
use Carbon\Carbon;
use App\Student_notifications;
use App\Language;
use App\User_otp;
use DB;
use App\Device_token;
use App\Notification;

class SocialLoginController extends Controller
{   

    /* login with Google */
    public function googleLogin(Request $request)
    {
        $provider = 'google'; 

        $fb_token = $request->google_token;

        $dtoken = $request->token;

        $providerUser = Socialite::driver($provider)->userFromToken($fb_token);  
    
        $user = User_meta::where('google_id', $providerUser->id)->first();   
        //print_r($user->user_id);
        $user_data = User::where('id',$user->user_id)->first();
       
        if($user==null)
        {

            return response()->json([
                'message' => 'Invalid credentials.'
                ], 401);
        }    // create a token for the user, so they can login
       
        $email = $providerUser->email;

        $users = DB::select('select * from users where email = ?',[$email]);

        if($users[0]->status=='2')
        {
            return response()->json([ 'message' => 'User rejected by admin.'], 452);
        }

        if(!$users[0]->is_blocked=='0')
        {
            return response()->json(['message' => 'User is blocked by admin.'], 454);
        }

        else if($users[0]->status=='0')
        {
            return response()->json(['message' => 'User approval pending from admin.'], 455);
        }

        $tokenResult = $user_data->createToken('Personal Access Token');
        
        $token = $tokenResult->token;

        $token->expires_at = Carbon::now()->addHours(24);

        $token->save();


      $device_token_data= Device_token::where('user_id',$users[0]->id)->get(['id']);

        if(sizeof($device_token_data))
        {   
             $device_tokens= Device_token::where('user_id',$users[0]->id)->update(['token'=>$dtoken]);
        }
        else{

        $device_token = new Device_token;

        $device_token->user_id = $users[0]->id;

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

        $notifications = new Notification;

        $notifications->user_id = $users[0]->id;

        $notifications->subject = "Uniplusco";

        $notifications->message =  "Welcome to uniplusco!";

         $notifications->image = "icon.png";

        $notifications->save();

        return response()->json([

            'access_token' => $tokenResult->accessToken,

            'token_type' => 'Bearer',

            'expires_at' => Carbon::parse(

                $tokenResult->token->expires_at

            )->toDateTimeString(),

            'verified'=>$users[0]->verified,

            'user_id'=>$users[0]->id,

            // 'email'=>$users[0]->email

        ]);
        
    }

    /* signup with Google */
    public function googlesignup(Request $request)
    {

        $provider = 'google'; 

        $fb_token = $request->google_token;
        
        $university_email = $request->university_email;
        
        $otp = $request->otp;

        $providerUser = Socialite::driver($provider)->userFromToken($fb_token);  
    
        $user = User_meta::where('google_id', $providerUser->id)->first();
         
        if($request->university_email){
              
        $optdata = User_otp::where('email',$university_email)->where('otp',$otp)->get();
        
        if(sizeof($optdata))
        {
            if($user == null)
            {

                $data =  array( 'email_verified_at' => Carbon::now(),
                        'first_name' => $providerUser->name,
                         'last_name' => $providerUser->name,
                        'email' => $providerUser->email,
                        'user_type'=>'2',
                        'status'=>'0',
                        'verified'=>'1');

                $email = $providerUser->email;

                $user_data = DB::table('users')->insert($data);

                $users = DB::select('select * from users where email = ?',[$email]);
            
                $stu_id = rand(1000,9999);

                $student_id = 'ID'.$stu_id;

                $values = array (  'user_id' => $users[0]->id,
                    'student_id' =>  $student_id,
                    'university_email'=>$request->university_email,
                    'google_id' => $providerUser->id);

               $user_meta = DB::table('user_metas')->insert($values);
            
               $languages = new Language;

               $languages->user_id = $users[0]->id;

               $languages->language = $language;

               $languages->save();
               
                $email = $providerUser->email;
            
             $users = DB::select('select * from users where email = ?',[$email]);
                
                $user_data = User::where('id',$users[0]->id)->first();
                
                $tokenResult = $user_data->createToken('Personal Access Token');
    
                $token = $tokenResult->token;
                
                return response()->json([
                
                'access_token' => $tokenResult->accessToken,

                'token_type' => 'Bearer',

                'expires_at' => Carbon::parse(

                    $tokenResult->token->expires_at

                )->toDateTimeString(),

                'verified'=>$users[0]->verified,

                'user_id'=>$users[0]->id,

                // 'email'=>$users[0]->email

            ]);
            
       
         // return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'User created successfully !','user_id'=>$users[0]->id]);
            }    // create a token for the user, so they can login
       
            return response()->json(['status_code'=>0,'status_text'=> 'Success','message'=>'User already registered !']);
        
        }

        else
        {
            return response()->json(['status_code'=>0,'status_text'=> 'Success','message'=>'University Email not verified!']); 
        } 
        }else{
            $data =  array( 'email_verified_at' => Carbon::now(),
                        'first_name' => $providerUser->name,
                         'last_name' => $providerUser->name,
                        'email' => $providerUser->email,
                        'user_type'=>'2',
                        'status'=>'0',
                        'verified'=>'1');

                $email = $providerUser->email;

                $user_data = DB::table('users')->insert($data);

                $users = DB::select('select * from users where email = ?',[$email]);
            
                $stu_id = rand(1000,9999);

                $student_id = 'ID'.$stu_id;

            
               $languages = new Language;

               $languages->user_id = $users[0]->id;

               $languages->language = $language;

               $languages->save();
               
                $email = $providerUser->email;
        
             
                if($request->university_id_photo){       
                   
                    
                    $ufile = $request->file('university_id_photo');
                    
                    $uextention = $ufile->getClientOriginalExtension();
                    
                    $ufilename = 'uni'.time().'.'.$uextention;
                    
                    $ufile->move('category/', $ufilename);
                         
                     $values = array (  'user_id' => $users[0]->id,
                    'student_id' =>  $student_id,
                     'university_id_photo'=>$ufilename,
                    'google_id' => $providerUser->id);

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

                    return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'User created successfully !','user_id'=>$users[0]->id]); 
            }


     }    

    /* login with Facebook */
    public function facebookLogin(Request $request)
    {
            $provider = 'facebook';  

            $fb_token = $request->fb_token;

            $dtoken = $request->token;

            $providerUser = Socialite::driver($provider)->userFromToken($fb_token);  
            
            $user = User_meta::where('facebook_id', $providerUser->id)->first();    // if there is no record with these data, create a new user
             $user_data = User::where('id',$user->user_id)->first();
       
            if($user==null)
            {

                return response()->json([
                'message' => 'Invalid credentials.'
                ], 401);
            }

            $email = $providerUser->email;

            $users = DB::select('select * from users where email = ?',[$email]);
       
            if($users[0]->status=='2')
            {
              return response()->json(['message' => 'User rejected by admin.'], 452);
            }

            if(!$users[0]->is_blocked=='0')
            {
                return response()->json(['message' => 'User is blocked by admin.'], 454);
            }

            else if($users[0]->status=='0')
            {
                return response()->json(['message' => 'User approval pending from admin.'], 455);
            }

            $tokenResult = $user_data->createToken('Personal Access Token');
    
            $token = $tokenResult->token;

            $token->expires_at = Carbon::now()->addHours(24);

            $token->save();

            $device_token_data= Device_token::where('user_id',$users[0]->id)->get(['id']);

        if(sizeof($device_token_data))
        {   
             $device_tokens= Device_token::where('user_id',$users[0]->id)->update(['token'=>$dtoken]);
        }
        else{

        $device_token = new Device_token;

        $device_token->user_id = $users[0]->id;

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

            $notifications = new Notification;

            $notifications->user_id = $users[0]->id;

            $notifications->subject = "Uniplusco";

            $notifications->message =  "Welcome to uniplusco!";

            $notifications->image = "icon.png";

            $notifications->save();

            return response()->json([
                
                'access_token' => $tokenResult->accessToken,

                'token_type' => 'Bearer',

                'expires_at' => Carbon::parse(

                    $tokenResult->token->expires_at

                )->toDateTimeString(),

                'verified'=>$users[0]->verified,

                'user_id'=>$users[0]->id,

                // 'email'=>$users[0]->email

            ]);
        
    } 
     
   /* signup with Facebook */  
   public function facebooksignup(Request $request)
   {
        $provider = 'facebook';  

        $fb_token = $request->fb_token;

        $language = $request->language; 

        $university_email = $request->university_email;

        $otp = $request->otp;

        $providerUser = Socialite::driver($provider)->userFromToken($fb_token);  
        
        $user = User_meta::where('facebook_id', $providerUser->id)->first();    // if there is no record with these data, create a new user
         if($request->university_email){
        $optdata = User_otp::where('email',$university_email)->where('otp',$otp)->get();

        if(sizeof($optdata))
        {

           if($user == null)
           {

               $data =  array( 'email_verified_at' => Carbon::now(),
                        'first_name' => $providerUser->name,
                         'last_name' => $providerUser->name,
                        'email' => $providerUser->email,
                        'user_type'=>'2',
                        'status'=>'1',
                        'verified'=>'1');

                $email = $providerUser->email;

                $user_data = DB::table('users')->insert($data);

                $users = DB::select('select * from users where email = ?',[$email]);
                
                $stu_id = rand(1000,9999);

                $student_id = 'ID'.$stu_id;

                $values = array (  'user_id' => $users[0]->id,
                        'student_id' =>  $student_id,
                        'university_email'=>$request->university_email,
                        'facebook_id' => $providerUser->id);

                $user_meta = DB::table('user_metas')->insert($values);

                $languages = new Language;

                $languages->user_id = $users[0]->id;

                $languages->language = $language;

                $languages->save();
                
                $email = $providerUser->email;
                
                $users = DB::select('select * from users where email = ?',[$email]);
                
                $user_data = User::where('id',$users[0]->id)->first();
                
                $tokenResult = $user_data->createToken('Personal Access Token');
    
                $token = $tokenResult->token;
                
                return response()->json([
                
                'access_token' => $tokenResult->accessToken,

                'token_type' => 'Bearer',

                'expires_at' => Carbon::parse(

                    $tokenResult->token->expires_at

                )->toDateTimeString(),

                'verified'=>$users[0]->verified,

                'user_id'=>$users[0]->id,

                // 'email'=>$users[0]->email

            ]);
       
           
            //return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'User created successfully !','user_id'=>$users[0]->id]);
            }    // create a token for the user, so they can login

            
              return response()->json(['status_code'=>0,'status_text'=> 'Success','message'=>'User already registered !']);
        }

        else
        {
            return response()->json(['status_code'=>0,'status_text'=> 'Success','message'=>'University Email not verified!']); 
        }
        
   }else{
            $data =  array( 'email_verified_at' => Carbon::now(),
                        'first_name' => $providerUser->name,
                         'last_name' => $providerUser->name,
                        'email' => $providerUser->email,
                        'user_type'=>'2',
                        'status'=>'0',
                        'verified'=>'1');

                $email = $providerUser->email;

                $user_data = DB::table('users')->insert($data);

                $users = DB::select('select * from users where email = ?',[$email]);
            
                $stu_id = rand(1000,9999);

                $student_id = 'ID'.$stu_id;

            
               $languages = new Language;

               $languages->user_id = $users[0]->id;

               $languages->language = $language;

               $languages->save();
               
                $email = $providerUser->email;
        
             
                if($request->university_id_photo){       
                   
                    
                    $ufile = $request->file('university_id_photo');
                    
                    $uextention = $ufile->getClientOriginalExtension();
                    
                    $ufilename = 'uni'.time().'.'.$uextention;
                    
                    $ufile->move('category/', $ufilename);
                         
                     $values = array (  'user_id' => $users[0]->id,
                    'student_id' =>  $student_id,
                     'university_id_photo'=>$ufilename,
                    'google_id' => $providerUser->id);
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

                    return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'User created successfully !','user_id'=>$users[0]->id]); 
            }

   }
}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Auth;
use App\User_meta;
use App\Qrcodes;
class User extends Authenticatable
{
     use HasApiTokens,  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'plane_password',
        'address',
        'user_type',
        'status',
        'verified',
        'is_blocked'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
      public function getUserImageUrlAttribute()
    {   
        $user = Auth::user()->id;
        $data =User_meta::where('user_id',$user)->get(['image']);
        $image = '/public/category/'.$data[0]->image;
        return  $image ;
    }

    public function getQrImageUrlAttribute()
    {   
        $user = Auth::user()->id;

        $user_data = User::where('id',$user)->get(['user_type']);
        
        if($user_data[0]->user_type == 2){

        $data =Qrcodes::where('user_id',$user)->get(['image']);

        $image = '/public/qrcode/'.$data[0]->image;

        return  $image ;

         }
    }
     public function getUniversityIdPhotoUrlAttribute()
    {   
        $user = Auth::user()->id;
        $data =User_meta::where('user_id',$user)->get(['university_id_photo']);
        if($data[0]->university_id_photo == null){
            return  null ;
        }else{
        $image = '/public/category/'.$data[0]->university_id_photo;
        return  $image ;
        }
    }

    public function toArray()
    {
        $array = parent::toArray();
        foreach ($this->getMutatedAttributes() as $key)
        {
            if ( ! array_key_exists($key, $array)) {
                $array[$key] = $this->{$key};   
            }
        }
        return $array;
    }
}

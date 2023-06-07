<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
class User_meta extends Model
{
    use HasApiTokens;
     protected $table = 'user_metas';
    public $timestamps = true;
  
    protected $fillable = [
        'user_id','city','state','country','country_code','image','student_id','phone',
        'university_email','discription','university_id_photo','facebook_id',
        'facebook_token','google_token','google_id','amount'
    ];

   
}

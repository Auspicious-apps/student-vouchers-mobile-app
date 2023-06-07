<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_otp extends Model
{
   // use HasFactory;
     protected $table = 'user_otps';
    public $timestamps = true;
  
    protected $fillable = [
       'user_id','email','otp'
    ];
}

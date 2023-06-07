<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcodes extends Model
{
    //use HasFactory;
        protected $table = 'qrcodes';
    public $timestamps = true;
  
    protected $fillable = [
        'user_id','student_id','university_email','image'
    ];
  
}

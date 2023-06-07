<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_notifications extends Model
{
    //use HasFactory;
      protected $table = 'student_notifications';
    public $timestamps = true;
  
    protected $fillable = [
        'user_id','device_token',
    ];
}

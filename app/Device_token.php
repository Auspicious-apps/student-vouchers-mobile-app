<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device_token extends Model
{
    //use HasFactory;

    protected $table = 'device_tokens';
    public $timestamps = true;
  
    protected $fillable = [
        'user_id','token'
    ];
}

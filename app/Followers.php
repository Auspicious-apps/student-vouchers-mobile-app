<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
   // use HasFactory;
    protected $table = 'followers';
    public $timestamps = true;
  
    protected $fillable = [
        'user_id','voucher_id','status'
    ];
}

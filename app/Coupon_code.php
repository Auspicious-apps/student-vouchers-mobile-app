<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon_code extends Model
{
    //use HasFactory;

     protected $table = 'device_tokens';
    public $timestamps = true;
  
    protected $fillable = [
        'user_id','voucher_id','coupon_code','is_used'
    ];
}

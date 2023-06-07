<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
   // use HasFactory;
      protected $table = 'ratings';
    public $timestamps = true;
  
    protected $fillable = [
        'user_id','voucher_id','status'
    ];
}

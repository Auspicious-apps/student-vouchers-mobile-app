<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recent_view extends Model
{
   // use HasFactory;

    protected $table = "recently_viewed";
    public $timestamps = true;
    protected $fillable = [
    	'voucher_id','user_id'
    ];
}

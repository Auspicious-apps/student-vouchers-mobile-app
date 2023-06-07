<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use App\Voucher_sold;
class Voucher_sold extends Model
{
    //use HasFactory;

     protected $table = 'voucher_solds';
    public $timestamps = true;
  
    protected $fillable = [
        'student_id','voucher_id','amount','user_id'
    ];

    public function getFormattedAtAttribute()
    {   
        //$date=Carbon::createFromFormat('Y-m-d H:i:s',$this->created_at)->format('Y-m-d H:i');
       $date= date("d/m/Y h:i a", strtotime($this->created_at));
        return $date;
    }
    // public function getStudentAttribute()
    // {   
    
    //   $student = User_meta::where('user_id',$this->student_id)->get(['student_id']);
    //   if(sizeof($student)){
    //     return  $student[0]['student_id'];
    //   }else{
    //       $students = '';
    //       return  $students;
    //   }
    // }

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

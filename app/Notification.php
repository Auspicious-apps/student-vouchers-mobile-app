<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
   // use HasFactory;

     protected $table = 'notifications';
    public $timestamps = true;
  
    protected $fillable = [
        'user_id','subject','message','image','read_status'
    ];

    public function getImageUrlAttribute()
    {   
        $image = '/public/images/'.$this->image;

        return  $image ;

    }

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

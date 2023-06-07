<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
   // use HasFactory;
    protected $table = 'categories';
    public $timestamps = true;
  
    protected $fillable = [
        'name','image','parent_key',
    ];

    public function getImageUrlAttribute()
    {

        $image = '/public/category/'.$this->image;
        return $image;
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

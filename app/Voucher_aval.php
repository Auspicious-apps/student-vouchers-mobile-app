<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Whislist;
use App\Followers;
class Voucher_aval extends Model
{
    //use HasFactory;
     protected $table = 'voucher_avals';
    public $timestamps = true;
  
    protected $fillable = [
        'user_id','category_id','vou_quantity','vou_value','offer_type','amount',
        'start_date','end_date','brand_url','vou_code',
        'image','description','title','logo_image','brand','is_explore','category_index','explore_index','subcategories_id','terms_conditions'
    ];


    public function getImageUrlAttribute()
    {

        $image = '/public/category/'.$this->image;
        return $image;

    }

    public function getLogoUrlAttribute()
    {
        $logo_image = '/public/category/'.$this->logo_image;
        return $logo_image;
    }
    
    public function getWishlistAttribute()
    {
        $user_id = Auth::user()->id;

        $category_id = $saved_data = Whislist::where('user_id',$user_id)->where('voucher_id',$this->id)->get(['status']);

        for($i=0;$i<count($category_id);$i++)
        {

            if($category_id[$i]->status == 1){

                return 1;

            }else{

                 return 0;
            }

        }
         return 0;
       // return $category_id[$i]->status;
    }

     public function getFollowAttribute()
    {
        $user_id = Auth::user()->id;

        $category_id = $saved_data = Followers::where('user_id',$user_id)->where('voucher_id',$this->id)->get(['status']);

        for($i=0;$i<count($category_id);$i++)
        {

            if($category_id[$i]->status == 0){

                return 1;

            }else{

                 return 0;
            }

        }
         return 0;
       // return $category_id[$i]->status;
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

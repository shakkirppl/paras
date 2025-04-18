<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
class Offer extends Model
{
     protected $fillable = ['code', 'title', 'offer_categories_id','start_date','end_date','district_id','store_subscription_end_date','user_id','store_id','image','short_description','highlight_title','categories_id','sub_categories_id','descount_percentage','in_date','description','tags','latitude','longitude','offer_like','offer_deslike','no_of_use','views','hot_deal','trending','promote','applicable_on'];  // Add 'code' here
    use HasFactory,SoftDeletes;
    public function scopeRunning($query)
    {
        $today = Carbon::now()->toDateString();
    
        return $query->where('status', 'active')
                     ->where('verified', 'yes')
                     ->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today)
                     ->where('store_subscription_end_date', '>=', $today);
    }
    public function scopeDistrict($query,$value)
    {
      return $query->where(function($query)use ($value) {
        if ($value) {
            $query->where('district_id', $value);
        }
         });

    }
    public function scopeCity($query,$value)
    {
      return $query->where(function($query)use ($value) {
        if ($value) {
            $query->where('city_id', $value);
        }
         });

    }
    public function scopeCategory($query,$value)
    {
      return $query->where(function($query)use ($value) {
        if ($value) {
            $query->where('categories_id', $value);
        }
         });

    }
    public function scopeSubCategory($query,$value)
    {
      return $query->where(function($query)use ($value) {
        if ($value) {
            $query->where('sub_categories_id', $value);
        }
         });

    }
    public function scopeOfferCategory($query,$value)
    {
      return $query->where(function($query)use ($value) {
        if ($value) {
            $query->where('offer_categories_id', $value);
        }
         });

    }
    public function scopeActive($query)
    {
         return $query->where('status','active');
    }
    public function scopeInActive($query)
    {
         return $query->where('status','inactive');
    }
    public function scopeVerified($query)
    {
         return $query->where('verified','yes');
    }
    public function scopeNonVerified($query)
    {
         return $query->where('verified','no');
    }
    public function scopeRejected($query)
    {
         return $query->where('verified','rejected');
    }
    public function scopeUser($query,$user)
    {
         return $query->where('user_id',$user);
    }
    public function scopeStore($query,$store)
    {
         return $query->where('store_id',$store);
    }
    public function categories(){
        
        return $this->hasMany(Categories::class,'id','categories_id')->select('id','code','name');
     }
     public function subcategories(){
        
        return $this->hasMany(SubCategories::class,'id','sub_categories_id')->select('id','code','name');
     }
     public function offercategories(){
        
        return $this->hasMany(OfferCategory::class,'id','offer_categories_id')->select('id','code','name');
     }
     public function store(){
        
          return $this->hasMany(Store::class,'id','store_id')->select('id','code','name','logo');
       }
    
       public function adstore()
{
    return $this->belongsTo(Store::class, 'store_id', 'id')
                ->select('id', 'code', 'name', 'logo');
}
}

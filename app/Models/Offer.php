<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Offer extends Model
{
    use HasFactory;
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
}

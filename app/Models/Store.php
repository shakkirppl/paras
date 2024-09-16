<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    public function scopeComplete($query)
    {
         return $query->where('register_status','complete');
    }
    public function scopePending($query)
    {
         return $query->where('register_status','pending');
    }
    public function scopeRejected($query)
    {
         return $query->where('register_status','rejected');
    }
    public function scopeActive($query)
    {
         return $query->where('status','active');
    }
    public function scopeInActive($query)
    {
         return $query->where('status','inactive');
    }
    public function scopeUser($query,$user)
    {
         return $query->where('user_id',$user);
    }
    public function Type(){
        
     return $this->hasMany(StoreTypes::class,'id','store_types_id')->select('id','code','name');
  }
  public function Classification(){
        
     return $this->hasMany(StoreClassifications::class,'id','store_classifications_id')->select('id','code','name');
  }
}

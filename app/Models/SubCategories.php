<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubCategories extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','status','code','image','categories_id'];  // Add 'code' here
    public function scopeActive($query)
    {
         return $query->where('status','active');
    }
    public function category(){
        
        return $this->hasMany(Categories::class,'id','categories_id');
     }
}

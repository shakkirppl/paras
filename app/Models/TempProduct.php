<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TempProduct extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name', 'product_code', 'product_slug','model', 'description', 'summary', 'cover', 'brand_id', 
        'category_id', 'sub_category_id', 'extra_1', 'extra_2','extra_3','extra_4'
    ];
    public function skus(){
        return $this->hasMany('App\Models\TempProductSku','product_id')
        ->select('temp_product_skus.*');
         
     }
     public function skusBase(){
        return $this->hasMany('App\Models\TempProductSku', 'product_id', 'id')
                    ->where('base_unit', 'Yes')
                    ->select('id', 'image', 'product_id'); // Make sure to include 'product_id' in the select to match the relationship
    }
    public function images()
    {
        return $this->hasMany(TempProductImages::class, 'product_id');
    }
    public function category()
    {
        return $this->hasMany(Categories::class,'id','category_id')->select('id','name');
    }
    public function subCategory()
    {
        return $this->hasMany(SubCategories::class,'id', 'sub_category_id')->select('id','name');
    }
    public function brand()
    {
        return $this->hasMany(Brand::class,'id', 'brand_id')->select('id','name');
    }
}

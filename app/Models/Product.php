<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    protected $table = 'products'; // Ensure there are no spaces
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name', 'product_code', 'product_slug', 'description', 'summary', 'cover', 'brand_id', 
        'category_id', 'sub_category_id', 'productBaseUnitID', 'multi_unit', 'process_complete'
    ];

    public function skus(){
        return $this->hasMany('App\Models\ProductSku','product_id')
        ->select('product_skus.*');
         
     }
     public function skusBase(){
        return $this->hasMany('App\Models\ProductSku', 'product_id', 'id')
                    ->where('base_unit', 'Yes')
                    ->select('id', 'image', 'product_id'); // Make sure to include 'product_id' in the select to match the relationship
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

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}

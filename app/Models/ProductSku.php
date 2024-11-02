<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductImage;
class ProductSku extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'productUnitID', 'product_id', 'size_attributes_id', 'color_attributes_id', 'sku', 
        'price', 'offer_price', 'descount_percentage', 'stock', 'user_id', 'store_id', 'base_unit', 'image'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function color()
    {
        return $this->hasMany(ProductAttribute::class,'id', 'color_attributes_id');
    }

    public function size()
    {
        return $this->hasMany(ProductAttribute::class,'id', 'size_attributes_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'productUnitID');
    }
}

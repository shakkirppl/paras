<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // Ensure there are no spaces
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name', 'product_code', 'product_slug', 'description', 'summary', 'cover', 'brand_id', 
        'category_id', 'sub_category_id', 'productBaseUnitID', 'multi_unit', 'process_complete'
    ];

    public function skus()
    {
        return $this->hasMany(ProductSku::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}

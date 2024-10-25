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
    public function skus()
    {
        return $this->hasMany(TempProductSku::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(TempProductImages::class, 'product_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TempProductSku extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'product_id', 
        'size_attributes_id', 
        'color_attributes_id', 
        'sku', 
        'base_unit', 
        'image'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
  // Relationship for Size Attribute
  public function size()
  {
      return $this->belongsTo(ProductAttribute::class, 'size_attributes_id');
  }

  // Relationship for Color Attribute
  public function color()
  {
      return $this->belongsTo(ProductAttribute::class, 'color_attributes_id');
  }

}

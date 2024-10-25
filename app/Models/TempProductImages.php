<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TempProductImages extends Model
{
    use HasFactory;
    protected $fillable = ['product_sku_id', 'product_id', 'image'];
}

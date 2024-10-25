<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['productUnitID', 'product_id', 'image'];
}

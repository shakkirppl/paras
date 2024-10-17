<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductAttribute extends Model
{
    use HasFactory, SoftDeletes;

    // Define the table name
    protected $table = 'product_attributes';

    // Define fillable fields
    protected $fillable = ['type', 'value'];

    // Cast the type column to enum
    protected $casts = [
        'type' => 'string',
    ];
}

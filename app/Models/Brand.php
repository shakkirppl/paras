<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Brand extends Model
{
    protected $fillable = ['name', 'status', 'code','image'];  // Add 'code' here
    use HasFactory,SoftDeletes;
    public function scopeActive($query)
    {
         return $query->where('status','active');
    }
}

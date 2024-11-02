<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Categories extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name', 'status', 'code','image'];  // Add 'code' here
    public function scopeActive($query)
    {
         return $query->where('status','active');
    }

    public function subCategory()
    {
        return $this->hasMany('App\Models\SubCategories', 'categories_id', 'id')
                    ->where('status', 'active') // Adjust based on how you define active status (e.g., 1 or 'active')
                    ->select('id', 'categories_id', 'code', 'image', 'name'); // Ensure 'categories_id' is included
    }
}

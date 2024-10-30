<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferAdds extends Model
{
    use HasFactory;
    protected $fillable = [
        'offer_categories_id',
        'store_id',
        'description',
        'image',
        'offer_adds_type',
    ];
    public function scopeActive($query)
    {
         return $query->where('status','active');
    }
    public function category()
    {
        return $this->hasMany(OfferCategory::class,'id','offer_categories_id')->select('id','name');
    }
    public function store()
    {
        return $this->hasMany(Store::class,'id','store_id')->select('id','name');
    }
}

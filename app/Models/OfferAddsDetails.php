<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferAddsDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'master_id',
        'product_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

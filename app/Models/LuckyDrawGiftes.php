<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuckyDrawGiftes extends Model
{
    protected $fillable = ['lucky_draws_id', 'name', 'short_description', 'description'];
    use HasFactory;
    public function luckyDraw()
    {
        return $this->belongsTo(LuckyDraws::class, 'lucky_draws_id');
    }
}

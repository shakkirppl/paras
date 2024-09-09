<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuckyDraws extends Model
{
    use HasFactory;
    public function gifts()
    {
        return $this->hasMany(LuckyDrawGiftes::class, 'lucky_draws_id');
    }
}

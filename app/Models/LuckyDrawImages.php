<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuckyDrawImages extends Model
{
    protected $fillable = ['lucky_draw_id', 'images'];
    use HasFactory;
}

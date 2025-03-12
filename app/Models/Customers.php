<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'mobile ',
        'gender',
        'password',
        'user_id',
        'total_point',
        'spend_point',
        'current_point',
        'total_purchase_amount'
    ];
}

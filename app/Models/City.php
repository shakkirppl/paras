<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class City extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name', 'distrct_id'];  // Add 'code' here
    public function district(){
        
        return $this->hasMany(Districts::class,'id','distrct_id');
     }
}

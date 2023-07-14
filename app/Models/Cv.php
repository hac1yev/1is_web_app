<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;
    protected $table = 'cv';
    protected $guarded = [];
    protected $fillable = ['portfolio'];

    public function getCategory(){
        return $this->hasMany('App\Models\Categories','id','category_id')->first();
    }
    public function getUser(){
        return $this->hasMany('App\Models\User', 'id', 'user_id')->first();
    }
}

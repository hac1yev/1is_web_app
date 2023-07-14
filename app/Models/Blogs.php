<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $guarded = [];

    public function getUser(){
        return $this->hasMany('App\Models\User', 'id', 'user_id')->first();
    }
}

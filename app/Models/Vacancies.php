<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class Vacancies extends Model
{
    use HasFactory;
    protected $table = 'vacancies';
    protected $guarded = [];

    public function getCompany(){
        return $this->hasMany('App\Models\Companies','id','company_id')->first();
    }
    public function getCategory(){
        return $this->hasMany('App\Models\Categories','id','category_id')->first();
    }
    

    public function category(){
        return $this->belongTo(Categories::class,'id');
     }
    
}


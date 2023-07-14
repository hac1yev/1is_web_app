<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vacancies;

class Categories extends Model
{
    use HasFactory;
    protected $table ='categories';
    protected $guarded = [];


    // public static function categori() {
    //     return (new static)->hasMany(Vacancies::class, 'category_id');
       
    // }

    // public static function vakansiya() {
    //     return (new static)->belongsTo(Categories::class, 'categories_id');
    // }  

    public function vacancies(){
        return $this->hasMany(Vacancies::class);
    }
}

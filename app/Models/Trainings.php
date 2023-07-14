<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainings extends Model
{
    use HasFactory;
    protected $table = 'trainings';
    protected $guarded = [];

    public function getCompany(){
        return $this->hasMany('App\Models\Companies','id','company_id')->get()->first();
    }
}

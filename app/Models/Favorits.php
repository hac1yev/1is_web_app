<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorits extends Model
{
    protected $table = 'favorits';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

}

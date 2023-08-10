<?php

namespace Spatie\ActivityLog\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    
    protected $table = 'activity_log';
    protected $guarded = [];

    
}

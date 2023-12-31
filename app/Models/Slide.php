<?php

namespace App\Models;

use App\Traits\Activity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory, Activity;

    protected $guarded = [];
    
}

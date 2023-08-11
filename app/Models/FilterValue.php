<?php

namespace App\Models;

use App\Models\Filter;
use App\Traits\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FilterValue extends Model
{
    use HasFactory, Activity;
    protected $guarded = [];

    public function filter() : BelongsTo {
        return $this->belongsTo(Filter::class);
    }
}

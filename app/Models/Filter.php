<?php

namespace App\Models;

use App\Models\Category;
use App\Traits\Activity;
use App\Models\FilterValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Filter extends Model
{
    use HasFactory, Activity;

    protected $guarded = [];

    // protected $casts = ['values' => 'array'];

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class, 'category_filter', 'filter_id', 'category_id');
    }
    public function filterValues(): HasMany {
        return $this->hasMany(FilterValue::class);
    }

}

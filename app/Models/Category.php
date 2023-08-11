<?php

namespace App\Models;

use App\Traits\Slug;
use App\Traits\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory, Activity, Slug;

    protected $guarded = [];

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id','id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeWithChildren(Builder $query): void
    {
        $query->with(['children' => function($query) {
            $query->active()->orderBy('created_at', 'DESC');
        }]);
    }

    public function scopeWithProducts(Builder $query): void
    {
        $query->with(['products' => function($query) {
            $query->active()->with('media')->orderBy('created_at', 'DESC');
        }]);
    }
}

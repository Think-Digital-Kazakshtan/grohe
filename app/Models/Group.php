<?php

namespace App\Models;

use App\Traits\Slug;
use App\Traits\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory, Activity, Slug;

    protected $guarded = [];

    public function products():BelongsToMany {
        return $this->belongsToMany(Product::class, 'product_group', 'group_id', 'product_id');
    }

    public function scopeWithProducts(Builder $query): void
    {
        $query->with(['products' => function($query) {
            $query->active()->orderBy('created_at', 'DESC');
        }]);
    }

}

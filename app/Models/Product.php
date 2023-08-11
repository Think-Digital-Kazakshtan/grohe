<?php

namespace App\Models;

use App\Traits\Activity;
use App\Traits\Slug;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Activity, Slug;


    protected $guarded = [];
    protected $casts = [
        'params'=>'array',
        'params_detail'=>'array'
    ];

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function collection(): BelongsTo {
        return $this->belongsTo(Collection::class);
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('products');
    }

    public function groups(): BelongsToMany {
        return $this->belongsToMany(Group::class, 'product_group', 'product_id', 'group_id');
    }
}

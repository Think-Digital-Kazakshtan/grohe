<?php
namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;

trait Slug {
    public function scopeSlug(Builder $query, $slug): void
    {
        $query->where('slug', $slug);
    }
}
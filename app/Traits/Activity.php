<?php
namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;

trait Activity {
    public function scopeActive(Builder $query, $value = true): void
    {
        $query->where('is_active', $value);
    }
}

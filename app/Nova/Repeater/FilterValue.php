<?php

namespace App\Nova\Repeater;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Repeater\Repeatable;

class FilterValue extends Repeatable
{
    public static $model = \App\Models\FilterValue::class;
    /**
     * Get the fields displayed by the repeatable.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::hidden('uuid'),
            Text::make('Значение', 'title')
        ];
    }
}

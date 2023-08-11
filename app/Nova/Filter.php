<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Tag;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Repeater;
use App\Nova\Repeater\FilterValue;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\FilterValue as FilterValueResource;

class Filter extends Resource
{

    use Base;

    public static $labels = ['Фильтры', 'Фильтр', 'Магазин'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Filter>
     */
    public static $model = \App\Models\Filter::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'title')->rules('required', 'max:255'),
            Slug::make('Слаг', 'slug')->from('title')->separator('_')->rules(['required', 'max:255']),
            BelongsToMany::make('Категории', 'categories', 'App\Nova\Category')->hideFromIndex(),
            Tag::make('Categories', 'categories'),
            Repeater::make('filterValues')
                ->asHasMany()
                ->uniqueField('id')
                ->repeatables([
                    \App\Nova\Repeater\FilterValue::make(),
                ]),
            Boolean::make('Активный', 'is_active')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}

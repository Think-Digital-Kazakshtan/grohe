<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Color;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Outl1ne\MultiselectField\Multiselect;

class Product extends Resource
{
    use Base;

    public static $labels = ['Товары', 'Товар', 'Магазин'];
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Product>
     */
    public static $model = \App\Models\Product::class;

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
            Text::make('Sku')->rules(['required', 'max:255'])->sortable(),
            Text::make('Название', 'title')->rules(['required', 'max:255'])->sortable(),
            Slug::make('Слаг', 'slug')->from('title')->separator('_')->rules(['required', 'max:255'])->hideFromIndex(),
            BelongsTo::make('Коллекции', 'collection', 'App\Nova\Collection')->hideFromIndex(),
            BelongsToMany::make('Категории', 'categories', 'App\Nova\Category')->hideFromIndex(),
            Multiselect::make('Категории', 'categories')->belongsToMany(\App\Nova\Category::class)->taggable(),
            BelongsToMany::make('Наборы', 'groups', 'App\Nova\Group')->hideFromIndex(),
            Images::make('Изображение товара', 'images'),
            Text::make('Цвет', 'color')->hideFromIndex(),
            Country::make('Страна', 'made_in')->hideFromIndex(),
            Text::make('Гарантия', 'warranty')->hideFromIndex(),
            Trix::make('Описание', 'description')->rules(['required'])->hideFromIndex(),
            Textarea::make('Заметка', 'note')->hideFromIndex(),
            Number::make('Количество', 'quantity')->rules(['required'])->sortable(),
            Currency::make('Цена без скидки', 'old_price')->currency('KZT')->sortable(),
            Currency::make('Цена', 'price')->currency('KZT')->rules(['required'])->sortable(),
            KeyValue::make('Параметры', 'params')
                ->keyLabel('Название')
                ->valueLabel('Значение')
                ->actionText('Добавить')->rules(['json'])->hideFromIndex(),
            KeyValue::make('Параметры детально', 'params_detail')
                ->keyLabel('Название')
                ->valueLabel('Значение')
                ->actionText('Добавить')->rules(['json'])->hideFromIndex(),
            Boolean::make('Популярные', 'is_popular')->sortable(),
            Boolean::make('Скидки', 'is_promotion')->sortable(),
            Boolean::make('Активный', 'is_active')->sortable()
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

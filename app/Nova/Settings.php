<?php

namespace App\Nova;

use Eminiarts\Tabs\Tab;
use Laravel\Nova\Panel;
use App\Models\Category;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Outl1ne\MultiselectField\Multiselect;
use Outl1ne\NovaSimpleRepeatable\SimpleRepeatable;

class Settings
{
    public static function init()
    {
        \Outl1ne\NovaSettings\NovaSettings::addSettingsFields(
            [
                static::fields()
            ],
            [
                'home_categories' => 'collection',
            ]
        );
    }

    public static function fields()
    {
        $result = [];
        foreach (Category::select(['id', 'title'])->orderBy('created_at', 'DESC')->get() as $category) {
            $result[$category->id] = $category->title;
        }
        return [
            Tabs::make('Some Title', [
                Tab::make('Главная страница', [
                    Multiselect::make('Категории на главной странице', 'categories')
                        ->options($result)
                        ->placeholder('Выберите категории')
                        ->max(5)
                        ->saveAsJSON()
                        ->reorderable()
                        ->taggable(),
                    URL::make('Ссылка на Facebook', 'facebook'),
                    URL::make('Ссылка в Instagram', 'instagram'),
                    Number::make('Телефон', 'phone'),
                    Email::make('E-mail', 'email'),
                    Text::make('Адрес 1', 'address_1')->rules('max:255'),
                    Text::make('Адрес 2', 'address_2')->rules('max:255'),
                    Text::make('Адрес 3', 'address_3')->rules('max:255'),
                    Text::make('Время работы', 'work_time')->rules('max:255'),
                    URL::make('Ссылка на карту', 'map_link')
                ]),
                Tab::make('Прочее', [
                    Number::make('Paid To Date', 'paid_to_date')
                ]),
            ]),
        ];
    }
}
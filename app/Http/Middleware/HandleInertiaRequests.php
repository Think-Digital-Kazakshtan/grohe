<?php

namespace App\Http\Middleware;

use App\Models\Group;
use App\Models\Product;
use App\Models\Slide;
use Inertia\Middleware;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $promocode = null;
        if ($promocode = \Cart::getConditions()->first()) {
            $promocode = $promocode->getAttributes();
        }
        return array_merge(parent::share($request), [
            'categories' => Category::active()->whereNull('parent_id')->orderBy('position')->withChildren()->get(),
            'sets' => Group::active()->get(),
            'cart_count' => \Cart::getTotalQuantity(),
            'cart_total' => \Cart::getTotal(),
            'cartItems' => \Cart::getContent(),
            'promocode' => $promocode,
            'session' => session()->all(),
            'verification' => session()->get('verification') ?? null,
            'slides' => Slide::active()->orderBy('position')->get(),
            'settings' => nova_get_settings(),
            'flash' => [
                'notify' => $request->session()->get('notify'),
            ],
            'user' => auth('customer')->user(),
            'favorites' => auth('customer')->check() ? auth('customer')->user()->favorites()->with('media')->get() : [],
        ]);
    }
}
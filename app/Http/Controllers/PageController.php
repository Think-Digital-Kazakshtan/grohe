<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Services\HBepay;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class PageController extends BaseController
{
    public function index()
    {
        $query = Product::active()->with('media')->orderBy('created_at', 'DESC')->limit(5);
        $popular = $query->where('is_popular', true)->get();
        $promotion = $query->where('is_promotion', true)->get();
        return Inertia::render('Home', compact('popular', 'promotion'));
    }

    public function support()
    {
        return Inertia::render('Support');
    }

    public function checkout()
    {
        return Inertia::render('Checkout');
    }

    public function contacts()
    {
        return Inertia::render('Contacts');
    }

    public function cabinet()
    {
        return Inertia::render('Cabinet');
    }

    public function sales()
    {
        return Inertia::render('Sales');
    }

    public function searchPage()
    {
        return Inertia::render('SearchPage');
    }

    public function errorPage()
    {
        return Inertia::render('ErrorPage');
    }

    public function favorite()
    {
        return Inertia::render('Favorite');
    }

    public function pay()
    {
        session()->forget('verification');

        // $pay_order = new HBepay();
        // return $pay_order->gateway(
        //     "test",
        //     "test",
        //     "yF587AV9Ms94qN2QShFzVR3vFnWkhjbAK3sG",
        //     "67e34d63-102f-4bd1-898e-370781d0074d",
        //     "300022002",
        //     10,
        //     "KZT",
        //     "https://example.kz/success.html",
        //     "https://example.kz/failure.html",
        //     "https://example.kz/",
        //     "https://example.kz/order/1123/fail",
        //     "RU",
        //     "HB payment gateway",
        //     "test1",
        //     "",
        //     ""
        // );
    }

}
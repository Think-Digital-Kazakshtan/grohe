<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function delivery()
    {
        return Inertia::render('Support/Delivery');
    }

    public function pickup()
    {
        return Inertia::render('Support/Pickup');
    }

    public function requisites()
    {
        return Inertia::render('Support/Requisites');
    }

    public function payments()
    {
        return Inertia::render('Support/Payments');
    }

    public function return ()
    {
        return Inertia::render('Support/Return');
    }

    public function guarantee()
    {
        return Inertia::render('Support/Guarantee');
    }

    public function installation()
    {
        return Inertia::render('Support/Installation');
    }

    public function services()
    {
        return Inertia::render('Support/Services');
    }
    public function work()
    {
        return Inertia::render('Support/Work');
    }

}
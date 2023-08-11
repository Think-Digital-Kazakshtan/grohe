<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CabinetController extends Controller
{
    
    public function index()
    {
        return Inertia::render('Cabinet/Profile');
    }

    public function myOrders()
    {
        return Inertia::render('Cabinet/Orders');
    }

}
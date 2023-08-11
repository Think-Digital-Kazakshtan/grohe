<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function category(Request $request, $slug) {
        $category = Category::active()->slug($slug)->withChildren()->withProducts()->firstOrFail();
        return Inertia::render('Category', compact('category'));
    }

}

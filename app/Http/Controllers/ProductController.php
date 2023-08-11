<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function catalog(Request $request) {
        $products = Product::active()->with('media')->orderBy('created_at', 'DESC')->paginate(4);
        return Inertia::render('Catalog', compact('products'));
    }

    public function get(Request $request, $slug) {
        $product = Product::active()->slug($slug)->with('media', 'collection', 'categories')->firstOrFail();
        return Inertia::render('Product', compact('product'));
    }
}

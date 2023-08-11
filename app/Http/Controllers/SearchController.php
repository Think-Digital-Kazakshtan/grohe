<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->input('query');
        $query = Product::where('title', 'LIKE', '%$q%')->orWhere('sku', 'LIKE', '%$q%');
        $category_query = Category::where('title', 'LIKE', '%$q%');

        $count = $query->count() + $category_query->count();
        $products = $query->limit(4)->get();
        $categories = $category_query->get();
        return Response::json(array(
            'success' => true,
            'data'   => $products,
            'categories'   => $categories,
            'count' => $count
        ));
    }

    public function searchProd(Request $request)
    {
        $q = $request->input('query');
        $category = null;
        $selectedFilters = null;
        $searchquery = $q;
        $products = Product::where('title', 'LIKE', "%$q%")->orWhere('overview', 'LIKE',  "%$q%")->orWhere('code', 'LIKE', "%$q%")->orWhereHas('keywords', function ($query) use($q) {
            return $query->where('title', 'LIKE', "%$q%");
        })->with('category');
        $category = Category::where('title', 'LIKE', "%$q%")->first();
        $categories = Category::active()->orderBy('position')->get();
        $max_price = $products->max('new_price');
        $min_price = $products->min('new_price');
        $products = $products->paginate(12);
        return view('pages.products',compact('products', 'category', 'categories', 'selectedFilters', 'searchquery', 'min_price', 'max_price'));
    }

    private function to_cyrillic($string):string
    {
        $gost = [
            "a" => "а", "b" => "б", "v" => "в", "g" => "г", "d" => "д", "e" => "е", "yo" => "ё",
            "j" => "ж", "z" => "з", "ii" => "и", "ji" => "й", "k" => "к",
            "l" => "л", "m" => "м", "n" => "н", "o" => "о", "p" => "п", "r" => "р", "s" => "с", "t" => "т",
            "y" => "у", "f" => "ф", "h" => "х", "c" => "ц",
            "ch" => "ч", "sh" => "ш", "sch" => "щ", "ie" => "ы", "u" => "у", "ya" => "я", "A" => "А", "B" => "Б",
            "V" => "В", "G" => "Г", "D" => "Д", "E" => "Е", "Yo" => "Ё", "J" => "Ж", "Z" => "З", "I" => "И", "Ji" => "Й",
            "K" => "К", "L" => "Л", "M" => "М",
            "N" => "Н", "O" => "О", "P" => "П",
            "R" => "Р", "S" => "С", "T" => "Т", "Y" => "Ю", "F" => "Ф", "H" => "Х", "C" => "Ц", "Ch" => "Ч", "Sh" => "Ш",
            "Sch" => "Щ", "Ie" => "Ы", "U" => "У", "Ya" => "Я",
        ];
        return strtr($string, $gost);
    }

}
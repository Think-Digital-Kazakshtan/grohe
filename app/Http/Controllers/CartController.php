<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    public function index(Request $request) {
        $cart = \Cart::getTotalQuantity();
        $cartItems = \Cart::getContent();
        return Inertia::render('Cart', ['cartItems' => $cartItems]);
    }

    public function add(Request $request) {
        $product = Product::find($request->post('id'));
        \Cart::add(array(
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'media' => $product->media,
            'quantity' => $request->post('quantity'),
            'attributes' => array(),
            'associatedModel' => $product
        ));

        notify('Товар успешно добавлен в корзину', button: ['Перейти в корзину', 'cart.index']);

        return redirect()->back();
    }

    public function update(Request $request) {
        
        \Cart::update($request->post('id'), [
            'quantity' => $request->post('quantity')
        ]);

        return redirect()->back();
    }

    public function delete(Request $request) {
        $product = Product::find($request->post('id'));
        \Cart::remove($product->id);

        notify('Товар успешно удален из корзины');
        
        return redirect()->back();
    }

    public function clear(Request $request)
    {
        \Cart::clear();

        notify('Корзина успешно очищена');

        return redirect()->back();
    }

    public function applyPromocode(Request $request)
    {
        Validator::make($request->all(), [
            'code' => ['required', 'string', 'exists:promocodes'],
        ])->validate();

        $code = $request->post('code');

        $promocode = Promocode::where('code', $code)->first();
        \Cart::clearCartConditions();
        $condition = new \Darryldecode\Cart\CartCondition([
            'name' => $code,
            'type' => 'discount',
            'target' => 'total',
            'value' => "-" . $promocode->amount . ($promocode->is_percent ? "%" : ""), 
            'attributes' => [
                'code' => $promocode->code,
                'amount' => $promocode->amount,
                'is_percent' => $promocode->is_percent
            ],
        ]);
        
        \Cart::condition($condition);

        notify('Промокод успешно активирован'.\Cart::getTotal());

        return redirect()->back();
    }
}

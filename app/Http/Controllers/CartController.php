<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
public function add(Request $request) {
    $request->validate([
        'product_id' => 'required|integer',
        'qty' => [
            'required',
            'integer',
            'min:1',
            'regex:/^[1-9][0-9]*$/'
        ],
    ]);

    $data = $request->all();
    $product = Product::findOrFail($data['product_id']);
    $cart = new Cart();
    $cart->addToCart($product, $data['qty']);

    return response()->json([
        'success' => true,
        'cart_qty' => session('cart_qty', 0),
        'cart_total' => session('cart_total', 0),
    ]);
}
    
    public function show() {
        return view('cart.cart-modal');
    }

    public function delItem($product_id) {
        $cart = new Cart();
        $cart->delItem($product_id);
        return view('cart.cart-modal');
    }

    public function clear() {
        session()->forget('cart');
        session()->forget('cart_qty');
        session()->forget('cart_total');
        return view('cart.cart-modal');
    }
}



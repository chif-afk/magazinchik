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
            'qty' => 'required|integer',
        ]);
        
        $data = $request->all();
        $product = Product::findOrFail($data['product_id']);
        $cart = new Cart();
        $cart->addToCart($product, $data['qty']);

        return view('cart.cart-modal');
    }
    
    public function show() {
        return view('cart.cart-modal');
    }
}



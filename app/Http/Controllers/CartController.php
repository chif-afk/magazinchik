<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

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

    public function checkout(Request $request) {
        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ]);
            $data = $request->all();

            DB::transaction(function() use ($data) {
                $order_data = array_merge([
                    'qty' => session('cart_qty'),
                    'total' => session('cart_total'),
                ], $data);
                $order = Order::create($order_data);
                $order->products()->createMany(session('cart'));
            });

            session()->forget('cart');
            session()->forget('cart_qty');
            session()->forget('cart_total');
            return redirect()->route('cart.checkout')->with('success', 'Заказ оформлен');
        }
        return view('cart.checkout');
    }
}



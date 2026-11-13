<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $qty = max(1, (int) $request->input('qty', 1));
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = [
                'title' => $product->title,
                'slug' => $product->slug,
                'price' => $product->price,
                'img' => $product->getImage(),
                'qty' => $qty,
            ];
        }
        
        session()->put('cart', $cart);
        
        // Подсчёт общего количества и суммы
        $cartQty = array_sum(array_column($cart, 'qty'));
        $cartTotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['qty'];
        }, $cart));
        
        session(['cart_qty' => $cartQty, 'cart_total' => $cartTotal]);
        
        // Для AJAX запросов возвращаем JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'cart_qty' => $cartQty,
            ]);
        }
        
        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    public function show()
    {
        $cart = session()->get('cart', []);

        $cartQty = 0;
        $cartTotal = 0;

        if (!empty($cart)) {
            $cartQty = array_sum(array_column($cart, 'qty'));
            $cartTotal = array_sum(array_map(function($item) {
                return $item['price'] * $item['qty'];
            }, $cart));
        }

        session(['cart_qty' => $cartQty, 'cart_total' => $cartTotal]);

        // Модалка корзины запрашивается по AJAX и ожидает HTML-фрагмент
        return view('cart.cart-modal', compact('cart', 'cartQty', 'cartTotal'))->render();
    }

    public function delItem($product_id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
        }
        
        $cartQty = 0;
        $cartTotal = 0;
        
        if (!empty($cart)) {
            $cartQty = array_sum(array_column($cart, 'qty'));
            $cartTotal = array_sum(array_map(function($item) {
                return $item['price'] * $item['qty'];
            }, $cart));
        }
        
        session(['cart_qty' => $cartQty, 'cart_total' => $cartTotal]);
        
        // mainmain.js ожидает JSON с HTML модального окна
        return response()->json([
            'success' => true,
            'html' => view('cart.cart-modal', compact('cart', 'cartQty', 'cartTotal'))->render(),
            'cart_qty' => $cartQty,
        ]);
    }

    public function clear()
    {
        session()->forget('cart');
        session(['cart_qty' => 0, 'cart_total' => 0]);

        // mainmain.js ожидает JSON с HTML модального окна
        return response()->json([
            'success' => true,
            'html' => view('cart.cart-modal', ['cart' => [], 'cartQty' => 0, 'cartTotal' => 0])->render(),
            'cart_qty' => 0,
        ]);
    }

    public function checkout(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string',
                'address' => 'required|string',
            ]);
            
            session()->forget('cart');
            session(['cart_qty' => 0, 'cart_total' => 0]);
            
            return redirect()->route('home')->with('success', 'Заказ оформлен!');
        }
        
        $cart = session()->get('cart', []);
        $categories = \App\Models\Category::all();
        
        return view('cart.checkout', compact('cart', 'categories'));
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function addToCart($product, $qty) {
        if (session()->has("cart.{$product->id}")) {
            session(["cart.{$product->id}.qty" => session("cart.{$product->id}.qty") + $qty]);
        } else {
            session(["cart.{$product->id}" => [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'price' => $product->price,
                'img' => $product->getImage(),
                'qty' => $qty,
            ]]);
        }

        if (session()->has('cart_qty')) {
            session(['cart_qty' => session('cart_qty') + $qty]);
        } else {
            session(['cart_qty' => $qty]);
        }

        if (session()->has('cart_total')) {
            session(['cart_total' => session('cart_total') + $qty * $product->price]);
        } else {
            session(['cart_total' => $qty * $product->price]);
        }
    }
}

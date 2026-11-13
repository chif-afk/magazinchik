<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'Home Page';
                $products = Product::with(['category', 'status'])
            ->orderBy('id', 'desc')
            ->paginate(12);

        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));

    }

    public function show(string $slug) {
        $product = Product::query()->with(['category', 'status'])->where('slug', $slug)->firstOrFail();
        return view('products.show', compact('product'));
    }
}

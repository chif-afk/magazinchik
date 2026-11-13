<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function show($slug) {
        $category = Category::query()->where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->with(['category', 'status'])
            ->paginate(12);

        $categories = Category::all();

        return view('products.index', compact('category', 'products', 'categories'));
    }
}

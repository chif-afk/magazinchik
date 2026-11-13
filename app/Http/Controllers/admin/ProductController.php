<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'status'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $statuses = Status::all();

        return view('admin.products.create', compact('categories', 'statuses'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['img'] = $this->uploadImage($request, null);

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар добавлен');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $statuses = Status::all();

        return view('admin.products.edit', compact('product', 'categories', 'statuses'));
    }


    public function update(Request $request, Product $product)
    {
        $data = $this->validateData($request);
        $data['img'] = $this->uploadImage($request, $product->img);

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар обновлён');
    }

    public function destroy(Product $product)
    {
        if ($product->img && Storage::disk('public')->exists($product->img)) {
            Storage::disk('public')->delete($product->img);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар удалён');
    }

    private function validateData(Request $request): array
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'qty' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hit' => 'nullable|boolean',
            'sale' => 'nullable|boolean',
        ]);

        $data = $request->except(['img', '_token', '_method']);
        $data['hit'] = $request->boolean('hit');
        $data['sale'] = $request->boolean('sale');

        return $data;
    }

    private function uploadImage(Request $request, ?string $old): ?string
    {
        if (!$request->hasFile('img')) {
            return $old;
        }

        if ($old && Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }

        return $request->file('img')->store('images', 'public');
    }
}
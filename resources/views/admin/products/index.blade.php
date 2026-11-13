@extends('layouts.layout')

@section('title', 'Товары')

@section('content')
<h1>Товары</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Добавить</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Картинка</th>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Старая цена</th>
            <th>Количество</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><img src="{{ $product->getImage() }}" alt="" width="80"></td>
            <td>{{ $product->title }}</td>
            <td>{{ number_format($product->price, 2) }} руб.</td>
            <td>
                @if($product->old_price)
                    {{ number_format($product->old_price, 2) }} руб.
                @endif
            </td>
            <td>{{ $product->qty ?? 0 }}</td>
            <td>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary btn-sm">✏️</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Удалить товар?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">Товаров пока нет</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $products->links() }}
@endsection
@extends('layouts.layout')
@section('@parent :: {{ $title }}')
@endsection
@section('content')
    <div class="col-md-12">
        <h1>Оформление заказа</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors-all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (!empty((session('cart'))))
        <div class="table-responsive cart-table">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Наименование</th>
                        <th>Цена</th>
                        <th>Кол-во</th>
                        <th><i class="fas fa-times"></i></th>
                    </tr>
                </thead>
                <tbody>
                @foreach (session('cart') as $key => $item)
                <tr>
                    <td>
                        <a href="{{ route('products.show', ['slug' => $item['slug']]) }}">
                            <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}">
                        </a>
                    </td>
                    <td><a href="{{ route('products.show', ['slug' => $item['slug']]) }}">{{ $item['title'] }}</a></td>
                    <td>@price_format($item['price']) руб.</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>
                        <span class="text-danger del-item" data-action="{{ route('cart.del_item', ['product_id' => $key]) }}">
                            <i class="fas fa-times"></i>
                        </span>
                    </td>
                </tr>
                @endforeach
                    <tr>
                        <td colspan="4" align="right">Итого:</td>
                        <td id="modal-cart-qty">{{ session('cart_qty')}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">На сумму:</td>
                        <td id="modal-cart-total">@price_format(session('cart_total'))руб.</td>
                    </tr>
                </tbody>
            </table>    
    </div>

    <form method="post" action="{{ route('cart.checkout') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="note">Note</label>
            <textarea name="note" id="note" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @else
        <h4>Корзина пустая</h4>
    @endif
@endsection
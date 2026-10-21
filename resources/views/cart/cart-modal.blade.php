@if (!empty((session('cart'))))
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Фото</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Кол-во</th>
                </tr>
            </thead>
            <tbody>
                @foreach (session('cart') as $item)
                <tr>
                    <td>
                        <a href="{{ route('products.show', ['slug' => $item['slug']]) }}">
                            <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}">
                        </a>
                    </td>
                    <td><a href="{{ route('products.show', ['slug' => $item['slug']]) }}">{{ $item['title'] }}</a></td>
                    <td>{{ $item['price'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" align="right">Итого:</td>
                    <td id="modal-cart-qty">{{ session('cart_qty') }}</td>
                </tr>
                <tr>
                    <td colspan="3" align="right">На сумму:</td>
                    <td id="modal-cart-total">@price_format(session('cart_total'))руб.</td>
                </tr>
            </tbody>
        </table>    
    </div>
@else
    <h4>Корзина пустая</h4>
@endif
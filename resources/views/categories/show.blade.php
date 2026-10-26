@extends('layouts.layout')
@section('@parent :: {{ $title }}')
@endsection
@section('content')
    <div class="product-cards mb-5">
        <div class="col-md-12">
            @forelse($products as $product)
                <div class="product-card">
                    <div class="offer">
                        @if($product->hit)
                            <div class="offer-hit">Hit</div>
                        @endif
                        @if($product->sale)
                            <div class="offer-sale">Sale</div>
                        @endif
                    </div>
                    <div class="card-thumb">
                        <a href="{{ route('products.show', ['slug' => $product->slug]) }}">
                            <img src="{{ $product->getImage() }}" alt="">
                        </a>
                    </div>
                    <div class="card-caption">
                        <div class="card-title">
                            <a href="{{ route('products.show', ['slug' => $product->slug]) }}">{{ $product->title }}</a>
                        </div>
                        <div class="card-price text-center">
                            @if($product->old_price)
                                <del><small>{{ $product->old_price }} руб.</small></del>
                            @endif
                            {{ $product->price }} руб.
                        </div>

                        <form action="{{ route('cart.add') }}" method="post" class="addtocart">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="qty" value="1" class="form-control">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info btn-block cart-addtocart">
                                        <i class="fas fa-cart-arrow-down"></i> Купить
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="item-status"><i class="{{ $product->status->icon }}"></i> {{ $product->status->title }}</div>
                    </div>
                </div><!-- /product-card -->
            @empty
                <p>В этой категории пусто</p>
            @endforelse
        </div>
    </div><!-- /product-cards -->
    <div class="col-md-12">
        <nav aria-label="Page navigation example">
            {{ $products->links() }}
        </nav>
    </div>

        <div class="product-card">
            <div class="offer">
                <div class="offer-hit">Hit</div>
            </div>
            <div class="card-thumb">
                <a href="product.html"><img src="{{ asset('assets/front/img/2.jpg') }}" alt=""></a>
            </div>
            <div class="card-caption">
                <div class="card-title">
                    <a href="product.html">Crafter D6/N Акустическая гитара</a>
                </div>
                <div class="card-price text-center">
                    12 626 руб.
                </div>
                <button type="button" class="btn btn-info btn-block card-addtocart">
                    <i class="fas fa-cart-arrow-down"></i> Купить
                </button>
                <div class="item-status">
                    <i class="far fa-pause-circle text-danger"></i> Ожидается
                </div>
            </div>
        </div><!-- /product-card -->

        <div class="product-card">
            <div class="card-thumb">
                <a href="product.html"><img src="{{ asset('assets/front/img/16.jpg') }}" alt=""></a>
            </div>
            <div class="card-caption">
                <div class="card-title">
                    <a href="product.html">Crafter MD-42/TR Акустическая гитара</a>
                </div>
                <div class="card-price text-center">
                    9 006 руб.
                </div>
                <button type="button" class="btn btn-info btn-block card-addtocart">
                    <i class="fas fa-cart-arrow-down"></i> Купить
                </button>
                <div class="item-status">
                    <i class="fas fa-check text-success"></i> В наличии
                </div>
            </div>
        </div><!-- /product-card -->

        <div class="product-card">
            <div class="card-thumb">
                <a href="product.html"><img src="{{ asset('assets/front/img/no-image.png') }}" alt=""></a>
            </div>
            <div class="card-caption">
                <div class="card-title">
                    <a href="product.html">CRAFTER TA070/Light Amber Акустическая гитара</a>
                </div>
                <div class="card-price text-center">
                    20 378 руб.
                </div>
                <button type="button" class="btn btn-info btn-block card-addtocart">
                    <i class="fas fa-cart-arrow-down"></i> Купить
                </button>
                <div class="item-status">
                    <i class="fas fa-shipping-fast text-muted"></i> В наличии на складе
                </div>
            </div>
        </div><!-- /product-card -->

    </div><!-- /product-cards -->

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>

    @if(count($products))
        <div class="col-md-12">
            <nav aria-label="Page navigation example">
                {{ $products->links() }} 
            </nav>
        </div>
    @endif
@endsection

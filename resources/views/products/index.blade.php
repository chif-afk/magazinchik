@extends('layouts.layout') 

@section('title', 'Главная')

@section('content')
    @if(session('success'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    <div class="col-12 mb-4">
        <h2 class="text-center">Каталог товаров</h2>
    </div>

    @forelse($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm">

                @if($product->hit)
                    <span class="badge badge-danger position-absolute" style="top: 10px; left: 10px; z-index: 10;">Hit</span>
                @endif
                @if($product->sale)
                    <span class="badge badge-warning position-absolute" style="top: 10px; right: 10px; z-index: 10;">Sale</span>
                @endif

                <a href="{{ route('products.show', $product->slug) }}" class="d-block text-center p-3">
                    <img src="{{ $product->getImage() ?? asset('assets/front/img/no-image.png') }}" 
                         class="img-fluid" 
                         style="max-height: 200px; object-fit: contain;" 
                         alt="{{ $product->title }}">
                </a>

                <div class="card-body d-flex flex-column text-center">
                    <h5 class="card-title">
                        <a href="{{ route('products.show', $product->slug) }}" class="text-dark text-decoration-none">
                            {{ $product->title }}
                        </a>
                    </h5>
                    
                    <div class="mt-auto">
                        <p class="card-text mb-2">
                            @if($product->old_price && $product->old_price > $product->price)
                                <span class="text-muted"><del>{{ number_format($product->old_price, 0, ',', ' ') }} ₽</del></span><br>
                            @endif
                            <span class="text-danger font-weight-bold" style="font-size: 1.2rem;">
                                {{ number_format($product->price, 0, ',', ' ') }} ₽
                            </span>
                        </p>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-shopping-cart mr-2"></i>В корзину
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <div class="alert alert-info">
                <i class="fas fa-box-open fa-3x mb-3"></i>
                <h4>Товаров пока нет</h4>
                <p>Загляните позже, мы скоро добавим новые позиции!</p>
            </div>
        </div>
    @endforelse

    {{-- Пагинация (Bootstrap 4 стиль) --}}
    <div class="col-12 mt-4">
        {{ $products->links() }}
    </div>

@endsection
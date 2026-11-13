@extends('layouts.layout')

@section('title', 'Админ-панель')

@section('content')
<h1>Админ-панель</h1>

<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Товары</h5>
                <p class="card-text">{{ \App\Models\Product::count() }}</p>
                <a href="{{ route('admin.products.index') }}" class="btn btn-light btn-sm">Управление</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Категории</h5>
                <p class="card-text">{{ \App\Models\Category::count() }}</p>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light btn-sm">Управление</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Теги</h5>
                <p class="card-text">{{ \App\Models\Tag::count() }}</p>
                <a href="{{ route('admin.tags.index') }}" class="btn btn-light btn-sm">Управление</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title">Посты</h5>
                <p class="card-text">{{ \App\Models\Post::count() }}</p>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-light btn-sm">Управление</a>
            </div>
        </div>
    </div>
</div>
@endsection
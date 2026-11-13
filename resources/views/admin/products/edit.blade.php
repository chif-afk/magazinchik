@extends('layouts.layout')

@section('title', 'Редактировать товар')

@section('content')
<h1>Редактировать: {{ $product->title }}</h1>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @include('admin.products._form')
</form>
@endsection
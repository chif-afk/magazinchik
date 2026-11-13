@extends('layouts.layout')

@section('title', 'Добавить товар')

@section('content')
<h1>Добавить товар</h1>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @include('admin.products._form')
</form>
@endsection
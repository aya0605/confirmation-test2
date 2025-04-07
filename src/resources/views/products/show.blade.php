@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product_show.css') }}">
@endsection

@section('content')
<div class="product-show__container">
    <h1 class="product-show__title">{{ $product->name }}</h1>
    <img src="{{ asset(str_replace('public', 'storage', $product->image_path)) }}" alt="{{ $product->name }}" class="product-show__image">
    <p class="product-show__price">価格: ¥{{ $product->price }}</p>
    <p class="product-show__description">説明: {{ $product->description }}</p>
    <p class="product-show__season">季節: {{ $product->season }}</p>
    <a href="{{ route('products.index') }}" class="product-show__back-button">戻る</a>
</div>
@endsection
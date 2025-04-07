@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product_list.css') }}">
@endsection

@section('content')
<h1>商品一覧</h1>

<div class="product-list__content">
    <div class="product-list__search">
        <a href="{{ route('products.create') }}" class="add-button">+商品を追加</a>

        <form action="{{ route('products.index') }}" method="get">
            <input type="text" name="search" value="{{ old('search', request('search')) }}" class="search-form__input">
            <button type="submit" class="search-form__button">検索</button>
        </form>

        <p>価格順で表示</p>
        <div class="sort-popup">
            <button type="button" class="sort-button">並び替え</button>
            <div class="sort-options">
                <a href="{{ route('products.index', ['sort' => 'high', 'search' => request('search')]) }}">高い順</a>
                <a href="{{ route('products.index', ['sort' => 'low', 'search' => request('search')]) }}">低い順</a>
            </div>
        </div>

        @if (request('sort'))
            <div class="sort-tag">
                並び替え条件: {{ request('sort') === 'high' ? '価格が高い順' : '価格が低い順' }}
                <a href="{{ route('products.index', ['search' => request('search')]) }}">×</a>
            </div>
        @endif
    </div>

    <div class="product-list__grid">
        @foreach ($products as $product)
        <div class="product-card">
            <a href="{{ route('products.show', $product->id) }}">
                @if ($product->image_path && Storage::exists(str_replace('public', 'public', $product->image_path)))
                    <img src="{{ asset('storage/image/' . $product->image_path) }}" alt="{{ $product->name }}" class="product-card__image">
                @else
                    <div class="product-card__no-image">画像がありません</div>
                @endif
                <div class="product-card__body">
                    <h2 class="product-card__title">{{ $product->name }}</h2>
                    <p class="product-card__price">¥{{ $product->price }}</p>
                </div>
            </a>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">
                    <img src="{{ asset('images/trash-icon.png') }}" alt="削除">
                </button>
            </form>
        </div>
        @endforeach
    </div>

    <div class="product-list__pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection
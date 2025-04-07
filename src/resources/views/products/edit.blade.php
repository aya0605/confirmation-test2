@extends('layouts.app')

@section('content')
    <h1>商品情報更新</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
            @error('name') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="price">値段</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}">
            @error('price') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="seasons">季節</label>
            @foreach ($seasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label>
            @endforeach
            @error('seasons') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="description">商品説明</label>
            <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
            @error('description') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="image">商品画像</label>
            <input type="file" name="image" id="image">
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="商品画像" style="max-width: 200px;">
            @error('image') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <button type="submit">変更を保存</button>
        <a href="{{ route('products.index') }}">戻る</a>
    </form>

    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">ゴミ箱ボタン</button>
    </form>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<h1>商品登録</h1>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="form">
    @csrf
    <div class="form__group">
        <label for="name" class="form__label">商品名 <span class="form__label--required">必須</span></label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form__input">
        @error('name')
            <p class="form__error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form__group">
        <label for="price" class="form__label">値段 <span class="form__label--required">必須</span></label>
        <input type="number" name="price" id="price" value="{{ old('price') }}" class="form__input">
        @error('price')
            <p class="form__error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form__group">
        <p class="form__label">季節 <span class="form__label--required">必須</span></p>
        <div class="form__checkbox-group">
            @foreach ($seasons as $season)
                <div class="form__checkbox-item">
                    <input type="checkbox" name="seasons[]" id="season-{{ $season->id }}" value="{{ $season->id }}" class="form__checkbox-input">
                    <label for="season-{{ $season->id }}" class="form__checkbox-label">{{ $season->name }}</label>
                </div>
            @endforeach
        </div>
        @error('seasons')
            <p class="form__error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form__group">
        <label for="image" class="form__label">商品画像 <span class="form__label--required">必須</span></label>
        <input type="file" name="image" id="image" class="form__input-file">
        @error('image')
            <p class="form__error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form__group">
        <label for="description" class="form__label">商品説明 <span class="form__label--required">必須</span></label>
        <textarea name="description" id="description" class="form__textarea">{{ old('description') }}</textarea>
        @error('description')
            <p class="form__error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form__group">
        <button type="submit" class="form__button">登録</button>
    </div>
</form>
@endsection
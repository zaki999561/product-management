@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2>商品情報一覧画面</h2>
     
    </div>
</div>

    <p><h2>ID</h2> {{ $product->id }}</p>
    <img src="{{ asset('images/' . $product->商品画像) }}" alt="{{ $product->商品名 }}">
    <p><h2>商品名</h2>  {{ $product->商品名 }}</p>
    <p><h2>メーカー</h2> {{ $product->bunrui->str }}</p>
    <p><h2>価格</h2> ￥{{ $product->価格 }}</p>
    <p><h2>在庫数</h2> {{ $product->在庫数 }}</p>
    <p><h2>コメント</h2> {{ $product->コメント }}</p>

    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">戻る</a>
    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning mt-3">編集</a>
@endsection

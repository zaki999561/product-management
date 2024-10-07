@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2>商品情報一覧画面</h2>
     
    </div>
</div>

    <p><h2>ID</h2> {{ $product->id }}</p>
    <img src="{{ asset('images/' . $product->img_path) }}" alt="{{ $product->product_name }}">
    <p><h2>商品名</h2>  {{ $product->product_name }}</p>
    <p><h2>メーカー</h2> {{ $product->Company->company_name }}</p>
    <p><h2>価格</h2> ￥{{ $product->price }}</p>
    <p><h2>在庫数</h2> {{ $product->stock }}</p>
    <p><h2>コメント</h2> {{ $product->comment }}</p>

    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">戻る</a>
    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning mt-3">編集</a>
@endsection

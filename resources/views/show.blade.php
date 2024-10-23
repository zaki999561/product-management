@extends('layouts.app')

@section('content')

<div class="row mb-4">
    <div class="col-lg-12">
        <h2>商品情報一覧画面</h2>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="mb-4">
            <h3>ID:</h3>
            <p>{{ $product->id }}</p>
        </div>

        <div class="mb-4">
            <img src="{{ asset('images/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="img-fluid">
        </div>

        <div class="mb-4">
            <h3>商品名:</h3>
            <p>{{ $product->product_name }}</p>
        </div>

        <div class="mb-4">
            <h3>メーカー:</h3>
            <p>{{ $product->Company->company_name }}</p>
        </div>

        <div class="mb-4">
            <h3>価格:</h3>
            <p>￥{{ number_format($product->price) }}</p>
        </div>

        <div class="mb-4">
            <h3>在庫数:</h3>
            <p>{{ $product->stock }}</p>
        </div>

        <div class="mb-4">
            <h3>コメント:</h3>
            <p>{{ $product->comment }}</p>
        </div>

        <div class="d-flex justify-content-start gap-2">
            <a href="{{ route('products.index') }}" class="btn btn-primary">戻る</a>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">編集</a>
        </div>
    </div>
</div>

@endsection

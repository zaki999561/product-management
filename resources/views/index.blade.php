@extends('layouts.app')

@section('title', '商品一覧画面')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>商品一覧画面</h2>
        <a class="btn btn-success" href="{{ route('products.create') }}">新規登録</a>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
        <th>メーカー名</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->商品画像 }}</td>
        <td>{{ $product->商品名 }}</td>
        <td style="text-align:right">{{ $product->価格 }}円</td>
        <td style="text-align:right">{{ $product->在庫数 }}</td>
        <td style="text-align:right">{{ $product->メーカー名 }}</td>
        <td>
            
        </td>
    </tr>
    @endforeach
</table>

{!! $products->links('pagination::bootstrap-5') !!}
@endsection

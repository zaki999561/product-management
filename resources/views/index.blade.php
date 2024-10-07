@extends('layouts.app')

@section('title', '商品一覧画面')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>商品一覧画面</h2>
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
        <th><a class="btn btn-warning" href="{{ route('products.create') }}">新規登録</a></th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->img_path }}</td>
        <td>{{ $product->product_name }}</td>
        <td style="text-align:right">{{ $product->price }}円</td>
        <td style="text-align:right">{{ $product->stock }}</td>
        <td style="text-align:right">{{ $product->company->company_name }}</td>
        <td>
        <a class="btn btn-primary" href="{{ route('products.show',$product->id) }}">詳細</a>
        <form action="{{ route('products.destroy',$product->id) }}" method="POST">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
</form>
        </td>
    </tr>
    @endforeach
</table>

{!! $products->links('pagination::bootstrap-5') !!}
@endsection

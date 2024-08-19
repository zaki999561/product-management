@extends('layouts.app')

@section('title', '商品一覧画面')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>商品一覧</h2>
        <a class="btn btn-success" href="{{ route('products.create') }}">新規作成</a>
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
        <th width="280px">操作</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->manufacturer }}</td>
        <td>
            <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">表示</a>
                <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">編集</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $products->links() !!}
@endsection

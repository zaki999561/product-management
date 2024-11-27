@extends('layouts.app')

@section('title', '商品一覧画面')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12">
        <h2>商品一覧画面</h2>
    </div>
</div>

@if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
<!-- 検索フォーム -->
<form action="{{ route('products.index') }}" method="GET" class="mb-4">
    <div class="row g-2 align-items-center">
        <!-- 商品名検索 -->
        <div class="col-md-4">
            <div class="form-group">
                <input 
                    type="text" 
                    name="keyword" 
                    placeholder="検索キーワード" 
                    class="form-control" 
                    value="{{ request('keyword') }}">
            </div>
        </div>

        <!-- メーカーセレクト -->
        <div class="col-md-4">
            <div class="form-group">
                <select name="company_id" class="form-select">
                    <option value="">メーカー名</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- 検索ボタン -->
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">検索</button>
        </div>
    </div>
</form>

<!-- 商品一覧テーブル -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th>
                <a class="btn btn-warning" href="{{ route('products.create') }}">新規登録</a>
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    <img src="{{ asset('images/' . $product->img_path) }}" alt="{{ $product->product_name }}" style="width: 100px; height: auto;">
                </td>
                <td>{{ $product->product_name }}</td>
                <td style="text-align:right">{{ $product->price }}円</td>
                <td style="text-align:right">{{ $product->stock }}</td>
                <td>{{ $product->company->company_name }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('products.show', $product->id) }}">詳細</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">該当する商品が見つかりませんでした。</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- ページネーション -->
<div class="d-flex justify-content-center">
    {!! $products->links('pagination::bootstrap-5') !!}
</div>
@endsection

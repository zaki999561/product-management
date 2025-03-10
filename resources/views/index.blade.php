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
<form id="search-form" class="mb-4">
    @csrf
    <div class="row g-2 align-items-center">
        <!-- 商品名検索 -->
        <div class="col-md-3">
            <div class="form-group">
                <input 
                    type="text" 
                    name="keyword" 
                    placeholder="商品名" 
                    class="form-control" 
                    value="{{ request('keyword') }}">
            </div>
        </div>

        <!-- メーカーセレクト -->
        <div class="col-md-3">
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

        <!-- 価格下限 -->
        <div class="col-md-2">
            <div class="form-group">
                <input 
                    type="number" 
                    name="price_min" 
                    placeholder="価格（下限）" 
                    class="form-control" 
                    value="{{ request('price_min') }}">
            </div>
        </div>

        <!-- 価格上限 -->
        <div class="col-md-2">
            <div class="form-group">
                <input 
                    type="number" 
                    name="price_max" 
                    placeholder="価格（上限）" 
                    class="form-control" 
                    value="{{ request('price_max') }}">
            </div>
        </div>

        <!-- 在庫数下限 -->
        <div class="col-md-2">
            <div class="form-group">
                <input 
                    type="number" 
                    name="stock_min" 
                    placeholder="在庫数（下限）" 
                    class="form-control" 
                    value="{{ request('stock_min') }}">
            </div>
        </div>

        <!-- 在庫数上限 -->
        <div class="col-md-2">
            <div class="form-group">
                <input 
                    type="number" 
                    name="stock_max" 
                    placeholder="在庫数（上限）" 
                    class="form-control" 
                    value="{{ request('stock_max') }}">
            </div>
        </div>

        <!-- 検索ボタン -->
        <div class="col-md-2">
            <button type="submit" id="search-btn" class="btn btn-primary">検索</button>
        </div>
    </div>
</form>

<!-- 商品一覧テーブル -->
<table class="table table-bordered" id="fav-table">
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
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </thead>
    <tbody id="product-list">
        @include('products.partials.product-list', ['products' => $products])
    </tbody>
</table>

<!-- ページネーション -->
<div class="d-flex justify-content-center">
    {!! $products->links('pagination::bootstrap-5') !!}
</div>
@endsection

@extends('layouts.app')

@section('title', '商品新規登録画面')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12 text-center">
        <h2 class="mt-4">商品新規登録画面</h2>
    </div>
</div>

@if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <div class="form-group">
                <label for="product_name" class="form-label">商品名<span class="text-danger">*</span></label>
                <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" placeholder="商品名" value="{{ old('商品名') }}">
                @error('product_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <div class="form-group">
                <label for="company_id" class="form-label">メーカー名<span class="text-danger">*</span></label>
                <select name="company_id" class="form-select @error('company_id') is-invalid @enderror" required>
                    <option value="" disabled selected>メーカーを選択</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
                @error('company_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <div class="form-group">
                <label for="price" class="form-label">価格<span class="text-danger">*</span></label>
                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="価格" value="{{ old('価格') }}">
                @error('price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <div class="form-group">
                <label for="在庫数" class="form-label">在庫数<span class="text-danger">*</span></label>
                <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="在庫数" value="{{ old('在庫数') }}">
                @error('stock')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <div class="form-group">
                <label for="comment" class="form-label">コメント</label>
                <textarea class="form-control" style="height: 100px" name="comment" placeholder="コメント">{{ old('コメント') }}</textarea>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <div class="form-group">
                <label for="img_path" class="form-label">商品画像</label>
                <input type="file" name="img_path" class="form-control">
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 offset-md-3 text-center">
            <button type="submit" class="btn btn-warning">新規登録</button>
            <a class="btn btn-primary" href="{{ route('products.index') }}">戻る</a>
        </div>
    </div>
</form>
@endsection

@extends('layouts.app')

@section('title', '商品情報編集画面')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12">
        <h2>商品情報編集画面</h2>
    </div>
</div>

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="row">
        <div class="col-12 mb-3">
            <label for="id" class="form-label">ID:</label><br>
            <strong>{{ $product->id }}</strong>
        </div>

        <div class="col-12 mb-3">
            <label for="product_name" class="form-label">商品名<span class="text-danger">*</span></label>
            <input type="text" id="product_name" name="product_name" value="{{ $product->product_name }}" class="form-control" placeholder="商品名を入力" required>
            @error('product_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 mb-3">
            <label for="company" class="form-label">メーカー名<span class="text-danger">*</span></label>
            <select id="company" name="company_id" class="form-select" required>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ $company->id == $product->company_id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
            @error('company_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 mb-3">
            <label for="price" class="form-label">価格<span class="text-danger">*</span></label>
            <input type="number" id="price" name="price" value="{{ $product->price }}" class="form-control" placeholder="価格を入力" required>
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 mb-3">
            <label for="stock" class="form-label">在庫数<span class="text-danger">*</span></label>
            <input type="number" id="stock" name="stock" value="{{ $product->stock }}" class="form-control" placeholder="在庫数を入力" required>
            @error('stock')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 mb-3">
            <label for="comment" class="form-label">コメント</label>
            <textarea id="comment" class="form-control" style="height:100px" name="comment" placeholder="コメントを入力">{{ $product->comment }}</textarea>
        </div>

        <div class="col-12 mb-3">
            <label for="img_path" class="form-label">商品画像</label>
            <input type="file" id="img_path" name="img_path" class="form-control">
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-warning">更新</button>
            <a class="btn btn-primary" href="{{ route('products.show', $product->id) }}">戻る</a>
        </div>
    </div>
</form>
@endsection

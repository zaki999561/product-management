@extends('layouts.app')

@section('title', '商品新規登録画面')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>商品新規登録画面</h2>
     
    </div>
</div>

<form action="{{ route('products.store') }}" method="POST"enctype="multipart/form-data">

@csrf

<div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="商品名" class="form-control"placeholder="商品名">
                @error('商品名')
                <span style="color:red;">必須項目です</span>
                @enderror
            </div>
        </div>
        
       
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <select name="メーカー名" class="form-select" required>
            @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
            </select>
            @error('メーカー名')
            <span style="color:red;">必須項目です</span>
            @enderror
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="価格" class="form-control" placeholder="価格">
                @error('価格')
                <span style="color:red;">必須項目です</span>
                @enderror
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="在庫数" class="form-control" placeholder="在庫数">
                @error('在庫数')
                <span style="color:red;">必須項目です</span>
                @enderror
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <textarea class="form-control" style="height:100px" name="コメント" placeholder="コメント"></textarea>
</div>
</div>


            
            <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <input type="file" name="商品画像" class="form-control">
</div>
</div>
<div class="col-12 mb-2 mt-2">
            <button type="submit" class="btn btn-warning">新規登録</button>
            </form>
            <a class="btn btn-primary" href="{{ route('products.index') }}">戻る</a>
</div>

            




@endsection

@extends('layouts.app')

@section('title', '商品新規登録画面')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>商品情報編集画面</h2>
     
    </div>
</div>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @method('PUT')
    @csrf

<div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="商品名" value="{{ $product->商品名 }}" class="form-control">
                @error('商品名')
                <span style="color:red;">必須項目です</span>
                @enderror
            </div>
        </div>
        
       
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <select name="メーカー名" class="form-select" required>
            @foreach ($bunruis as $bunrui)
                        <option value="{{ $bunrui->id }}">{{ $bunrui->str }}</option>
            @endforeach
            </select>
            @error('メーカー名')
            <span style="color:red;">必須項目です</span>
            @enderror
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="価格" value="{{ $product->価格 }}" class="form-control">
                @error('価格')
                <span style="color:red;">必須項目です</span>
                @enderror
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="在庫数" value="{{ $product->在庫数 }}" class="form-control">
                @error('在庫数')
                <span style="color:red;">必須項目です</span>
                @enderror
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <textarea class="form-control" style="height:100px" name="コメント">{{ $product->コメント }}</textarea>
            </div>
        </div>
   
            <div class="col-12 mb-2 mt-2">
               <div class="form-group">
                  <input type="file" name="商品画像" class="form-control">
               </div>
            </div>

        <div class="col-12 mb-2 mt-2">
            <button type="submit" class="btn btn-warning mt-3">更新</button>
            <a class="btn btn-primary mt-3" href="{{ route('products.show', $product->id) }}">戻る</a>
        </div>
</div>
            </form>


            




@endsection

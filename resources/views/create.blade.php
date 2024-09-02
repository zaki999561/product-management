@extends('layouts.app')

@section('title', '商品新規登録画面')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>商品新規登録画面</h2>
     
    </div>
</div>


    
<div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="商品名" class="form-control">
                @error('商品名')
                <span style=”color:red;”>必須項目です</span>
                @enderror
            </div>
        </div>
        
       
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <select name="メーカー名" class="form-select">
            </select>
            @error('メーカー名')
                <span style=”color:red;”>必須項目です</span>
            @enderror
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="価格" class="form-control">
                @error('価格')
                <span style=”color:red;”>必須項目です</span>
                @enderror
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="在庫数" class="form-control">
                @error('在庫数')
                <span style=”color:red;”>必須項目です</span>
                @enderror
            </div>
        </div>

        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <textarea class="form-control" style="height:100px" name="コメント"></textarea>
</div>
</div>


            
            <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <input type="file">



            <button type="submit" class="btn btn-primary">新規登録</button>
            <a class="btn btn-success" href="{{ url('/products') }}">戻る</a>

            




@endsection

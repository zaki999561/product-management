<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // コンストラクタで認証ミドルウェアを適用
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 商品一覧を表示
    public function index(Request $request)
{
    // 検索条件を取得
    $keyword = $request->input('keyword');
    $companyId = $request->input('company_id');

    // クエリビルダーで検索
    $query = Product::query();
    if (!empty($keyword)) {
        $query->where('product_name', 'like', '%' . $keyword . '%');
    }
    if (!empty($companyId)) {
        $query->where('company_id', $companyId);
    }

    // 商品データを取得
    $products = $query->with('company')->paginate(10);

    // メーカー一覧を取得
    $companies = Company::all(); // すべてのメーカー情報

    // ビューにデータを渡す
    return view('index', compact('products','companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
}

    



    // 商品作成画面を表示
    public function create()
    {
        $companies = Company::all();
        return view('create')->with('companies', $companies);
    }

    // 商品を保存
    public function store(ProductRequest $request)
{
    try {
        // モデルのメソッドを呼び出す
        $product = Product::createProduct($request->all());

        return redirect()->route('products.create')->with('success', '商品が正常に保存されました');
    } catch (\Exception $e) {
        return redirect()->route('products.create')->with('error', '商品の保存中にエラーが発生しました: ' . $e->getMessage());
    }
}

    // 商品の詳細を表示
    public function show(Product $product)
    {
        $companies = Company::all();
        $product = Product::with('company')->findOrFail($product->id);
        return view('show', compact('product'))->with('companies', $companies);
    }

    // 商品編集画面を表示
    public function edit(Product $product)
    {
        $companies = Company::all();
        return view('edit', compact('product'))
            ->with('page_id', request()->page_id)
            ->with('companies', $companies);
    }

    // 商品を更新
    public function update(ProductRequest $request, $id)
{
    try {
        $product = Product::findOrFail($id);

        // モデルのメソッドを呼び出す
        $product->updateProduct($request->all());

        return redirect()->route('products.edit', $product->id)
            ->with('success', '商品が正常に更新されました');
    } catch (\Exception $e) {
        return redirect()->route('products.edit', $id)
            ->with('error', '商品の更新中にエラーが発生しました: ' . $e->getMessage());
    }
}

    // 商品を削除
    public function destroy(Product $product)
{
    try {
        // モデルのメソッドを呼び出す
        $product->deleteProduct();

        return redirect()->route('products.index')
            ->with('success', '商品「' . $product->product_name . '」を削除しました');
    } catch (\Exception $e) {
        return redirect()->route('products.index')
            ->with('error', '商品の削除中にエラーが発生しました: ' . $e->getMessage());
    }
}
    
}

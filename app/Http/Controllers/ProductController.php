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
    DB::beginTransaction(); // トランザクション開始

    try {
        $product = new Product;

        // 画像ファイルの処理
        if ($request->hasFile('img_path')) {
            $image = $request->file('img_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->img_path = $imageName;
        }

        // 商品の属性を設定
        $product->fill($request->all());

        // 商品を保存
        $product->save();

        DB::commit(); // コミット
        return redirect()->route('products.create')->with('success', '商品が正常に保存されました');
    } catch (\Exception $e) {
        DB::rollBack(); // ロールバック

        // エラーメッセージをユーザーに返す
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
    DB::beginTransaction(); // トランザクション開始

    try {
        // 商品を取得
        $product = Product::findOrFail($id);

        // 画像ファイルの更新処理
        if ($request->hasFile('img_path')) {
            // 既存画像の削除
            if ($product->img_path) {
                $oldImagePath = public_path('images/' . $product->img_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // 新しい画像をアップロード
            $image = $request->file('img_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            // 画像パスをリクエストデータに追加
            $request->merge(['img_path' => $imageName]);
        }

        // fillメソッドで一括更新
        $product->fill($request->all())->save();

        DB::commit(); // コミット

        return redirect()->route('products.edit', $product->id)
            ->with('success', '商品が正常に更新されました');
    } catch (ModelNotFoundException $e) {
        DB::rollBack(); // ロールバック
        return redirect()->route('products.index')
            ->with('error', '商品が見つかりませんでした。');
    } catch (\Exception $e) {
        DB::rollBack(); // ロールバック
        return redirect()->route('products.edit', $id)
            ->with('error', '商品の更新中にエラーが発生しました: ' . $e->getMessage());
    }
}


    // 商品を削除
    public function destroy($id)
{
    try {
        $product = Product::findOrFail($id);
        $productName = $product->product_name;
        $product->delete();

        return response()->json(['success' => true, 'message' => "商品「{$productName}」が削除されました"]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => '削除中にエラーが発生しました']);
    }
}



    
}

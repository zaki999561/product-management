<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // コンストラクタで認証ミドルウェアを適用
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 商品一覧を表示
    public function index()
    {
        $products = Product::with('company')
            ->select([
                'id',
                'img_path',
                'product_name',
                'price',
                'stock',
                'company_id',
                'comment',
            ])
            ->orderBy('products.id', 'DESC')
            ->paginate(5);

        return view('index', compact('products'))
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
        $product = new Product;

        // 画像ファイルの処理
        if ($request->hasFile('img_path')) {
            $image = $request->file('img_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->img_path = $imageName;
        }

        // 商品の属性を設定
        $product->product_name = $request->input('product_name');
        $product->company_id = $request->input('company_id');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment = $request->input('comment');

        // 商品を保存
        $product->save();
        return redirect()->route('products.create')->with('success', '商品が正常に保存されました');
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
    public function update(ProductRequest $request, Product $product)
    {
        // 商品の属性を更新
        $product->product_name = $request->input('product_name');
        $product->company_id = $request->input('company_id');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment = $request->input('comment');

        // 画像ファイルの更新処理
        if ($request->hasFile('img_path')) {
            if ($product->img_path) {
                $oldImagePath = public_path('images/' . $product->img_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // 古い画像ファイルを削除
                }
            }

            $image = $request->file('img_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->img_path = $imageName; // 新しい画像ファイル名を設定
        }

        // 更新を保存
        $product->save();
        return redirect()->route('products.edit', $product->id)->with('success', '商品が正常に保存されました');
    }

    // 商品を削除
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', '商品を ' . $product->product_name . ' を削除しました');
    }
}

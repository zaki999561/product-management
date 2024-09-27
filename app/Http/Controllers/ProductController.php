<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Bunrui;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select([
        'products.id',
        'products.商品画像',
        'products.商品名',
        'products.価格',
        'products.在庫数',
        'bunruis.str as メーカー名',

])
->join('bunruis', 'products.メーカー名', '=', 'bunruis.id')
->orderBy('products.id', 'DESC')
->paginate(5);
        

        return view('index', compact('products'))
        
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        
        $bunruis = Bunrui::all();
        return view('create')
        ->with('bunruis',$bunruis);
    }

    public function store(Request $request)
    {
        $request->validate([
            '商品画像' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            '商品名' => 'required|max:20',
            'メーカー名' => 'required|string',
            '価格' => 'required|integer',
            '在庫数' => 'required|integer',
        ]);

        $product = new Product;
        if ($request->hasFile('商品画像')) {
            $image = $request->file('商品画像');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->商品画像 = $imageName;
        }
        $product->商品名 = $request->input('商品名');
        $product->メーカー名 = $request->input('メーカー名');
        $product->価格 = $request->input('価格');
        $product->在庫数 = $request->input('在庫数');
        $product->コメント= $request->input('コメント');
        $product->save();
        return redirect()->route('products.create')->with('success', '商品が正常に保存されました');
    }

    public function show(Product $product)
    {

    $bunruis = Bunrui::all();
    $product = Product::with('bunrui')->findOrFail($product->id);
    return view('show', compact('product'))
    ->with('bunruis',$bunruis);

    }

    public function edit(Product $product)
    {
        $bunruis = Bunrui::all();
    return view('edit', compact('product'))
    ->with('page_id',request()->page_id)
    ->with('bunruis',$bunruis);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            '商品画像' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            '商品名' => 'required|max:20',
            'メーカー名' => 'required|string',
            '価格' => 'required|integer',
            '在庫数' => 'required|integer',
        ]);
        $product->商品名 = $request->input('商品名');
        $product->メーカー名 = $request->input('メーカー名');
        $product->価格 = $request->input('価格');
        $product->在庫数 = $request->input('在庫数');
        $product->コメント= $request->input('コメント');

        if ($request->hasFile('商品画像')) {
            if ($product->商品画像) {
                $oldImagePath = public_path('images/' . $product->商品画像);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('商品画像');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $product->商品画像 = $imageName;
    }

        $product->save();
        return redirect()->route('products.edit', $product->id)->with('success', '商品が正常に保存されました');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
        ->with('success','商品を'.$product->name.'を削除しました');
    }
}

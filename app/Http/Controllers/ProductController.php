<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;


class ProductController extends Controller
{
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
            'comment'
])
->orderBy('products.id', 'DESC')
->paginate(5);
        

        return view('index', compact('products'))
        
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        
        $companies = Company::all();
        return view('create')
        ->with('companies',$companies);
    }

    public function store(Request $request)
    {
        $request->validate([
            'img_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_name' => 'required|max:20',
            'company_id' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        $product = new Product;
        if ($request->hasFile('img_path')) {
            $image = $request->file('img_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->img_path = $imageName;
        }
        $product->product_name = $request->input('product_name');
        $product->company_id = $request->input('company_id');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment= $request->input('comment');
        $product->save();
        return redirect()->route('products.create')->with('success', '商品が正常に保存されました');
    }

    public function show(Product $product)
    {

    $companies = Company::all();
    $product = Product::with('Company')->findOrFail($product->id);
    return view('show', compact('product'))
    ->with('companies',$companies);

    }

    public function edit(Product $product)
    {
        $companies = Company::all();
    return view('edit', compact('product'))
    ->with('page_id',request()->page_id)
    ->with('companies',$companies);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_name' => 'required|max:20',
            'company_id' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);
        $product->product_name = $request->input('product_name');
        $product->company_id = $request->input('company_id');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment= $request->input('comment');

        if ($request->hasFile('img_path')) {
            if ($product->img_path) {
                $oldImagePath = public_path('images/' . $product->img_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('img_path');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $product->img_path = $imageName;
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

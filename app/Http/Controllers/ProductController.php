<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Bunrui;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            '商品名' => 'required|max:20',
            'メーカー名' => 'required|integer',
            '価格' => 'required|integer',
            '在庫数' => 'required|integer',
        ]);

        $product = new Product;
    }

    public function show(Product $product)
    {
        
    }

    public function edit(Product $product)
    {
       
    }

    public function update(Request $request, Product $product)
    {
        
    }

    public function destroy(Product $product)
    {
       
    }
}

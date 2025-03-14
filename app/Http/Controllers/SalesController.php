<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Exception;

class SalesController extends Controller
{
    public function purchase(PurchaseRequest $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        try {
            // トランザクション開始
            DB::beginTransaction();

            // 商品をロックして取得（競合防止）
            $product = Product::lockForUpdate()->find($productId);

            if (!$product) {
                return response()->json(['message' => '商品が存在しません'], 404);
            }

            if ($product->stock < $quantity) {
                return response()->json(['message' => '在庫が不足しています'], 400);
            }

            // 在庫を減算
            $product->stock -= $quantity;
            $product->save();

            // 購入履歴を記録
            Sale::create([
                'product_id' => $productId,
            ]);

            // トランザクションをコミット
            DB::commit();

            return response()->json(['message' => '購入成功'], 200);
        } catch (Exception $e) {
            // トランザクションをロールバック
            DB::rollBack();

            return response()->json(['message' => '購入処理に失敗しました', 'error' => $e->getMessage()], 500);
        }
    }
}

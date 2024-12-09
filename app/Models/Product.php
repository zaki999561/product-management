<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'company_id',
        'stock',
        'price',
        'comment',
        'img_path',
    ];

    // リレーション：Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // 商品作成
    public static function createProduct(array $data)
    {
        DB::beginTransaction();

        try {
            $product = new self();
            $product->fill($data);

            // ファイルアップロード処理
            if (isset($data['img_path']) && $data['img_path'] instanceof \Illuminate\Http\UploadedFile) {
                $imageName = time() . '.' . $data['img_path']->getClientOriginalExtension();
                $data['img_path']->move(public_path('images'), $imageName);
                $product->img_path = $imageName;
            }

            $product->save();
            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // 商品更新
    public function updateProduct(array $data)
    {
        DB::beginTransaction();

        try {
            // 属性の更新
            $this->fill($data);

            // ファイルアップロード処理
            if (isset($data['img_path']) && $data['img_path'] instanceof \Illuminate\Http\UploadedFile) {
                // 既存画像の削除
                if ($this->img_path) {
                    $oldImagePath = public_path('images/' . $this->img_path);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $imageName = time() . '.' . $data['img_path']->getClientOriginalExtension();
                $data['img_path']->move(public_path('images'), $imageName);
                $this->img_path = $imageName;
            }

            $this->save();
            DB::commit();

            return $this;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // 商品削除
    public function deleteProduct()
    {
        DB::beginTransaction();

        try {
            // 画像削除処理
            if ($this->img_path) {
                $imagePath = public_path('images/' . $this->img_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $this->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // データを一括保存できるようにfillableを定義
    protected $fillable = [
        'product_id',
        'quantity',
    ];

    /**
     * 商品情報を取得する
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

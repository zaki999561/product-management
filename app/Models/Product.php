<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        '商品名',
        'メーカー名',
        '在庫数',
        '価格',
        '商品画像',
    ];
    public function bunrui()
    {
        return $this->belongsTo(Bunrui::class, 'メーカー名');
    }
}

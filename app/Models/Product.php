<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function Company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}

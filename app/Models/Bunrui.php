<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bunrui extends Model
{
    use HasFactory;
    protected $fillable = [
        'str', 
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'メーカー名');
    }
}

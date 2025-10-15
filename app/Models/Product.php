<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_name',
        'price',
        'stock',
        'description',
        'image'
    ];

    public static function getProducts()
    {
        // CHỈ lấy products có stock > 0 để hiển thị trên dashboard
        return self::where('stock', '>', 0)->get();
    }

}

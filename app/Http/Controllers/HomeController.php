<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Dữ liệu mẫu - sau này thay bằng database
        $products = [
            [
                'name' => 'Bánh Kem Sinh Nhật',
                'description' => 'Bánh kem tươi ngon, trang trí đẹp mắt',
                'price' => '350.000đ',
                'image' => 'cake1.jpg'
            ],
            [
                'name' => 'Bánh Kem Socola',
                'description' => 'Bánh socola đậm đà, béo ngậy',
                'price' => '280.000đ',
                'image' => 'cake2.jpg'
            ],
            [
                'name' => 'Bánh Kem Dâu',
                'description' => 'Bánh kem dâu tây tươi mát',
                'price' => '320.000đ',
                'image' => 'cake3.jpg'
            ],
            // Thêm sản phẩm khác...
        ];

        return view('home', compact('products'));
    }
}
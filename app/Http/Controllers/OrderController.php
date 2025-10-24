<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /*
     *** Hiển thị danh sách đơn hàng của user
     */
    public function index()
    {

        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        // Get user's orders với order items
        $orders = Order::where('user_id', auth()->id())
                      ->with('orderItems')
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        return view('orders.orders', compact('orders'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\AddToCart;

class OrderController extends Controller
{
    /*
     *** Hiển thị danh sách orders của user
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to view orders.');
        }

        $orders = Order::where('user_id', auth()->id())
                      ->with('orderItems')
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('orders', compact('orders'));
    }
    
    /*
     *** Hiển thị trang checkout
     */
    public function checkout()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to checkout.');
        }

        $user = auth()->user();
        
        // ✅ THÊM KIỂM TRA PHONE & ADDRESS
        if (!$user->phone || !$user->address) {
            return redirect()->route('profile.edit')
                           ->with('error', 'Please update your phone and address to proceed with checkout.');
        }

        $cartItems = AddToCart::getCartItemsByUserId($user->id);
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $totalAmount = AddToCart::getTotalAmount($user->id);

        return view('checkout', compact('user', 'cartItems', 'totalAmount'));
    }
    
    /*
     *** Xử lý đặt hàng
     */
    public function placeOrder(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to place order.');
        }

        $request->validate([
            'payment_method' => 'required|in:COD,Banking',
        ]);

        try {
            $user = auth()->user();
            $cartItems = AddToCart::getCartItemsByUserId($user->id);
            
            if ($cartItems->isEmpty()) {
                return redirect()->route('cart')->with('error', 'Your cart is empty.');
            }

            // Tạo order
            $order = Order::createFromCart($user, $cartItems, $request->payment_method);
            
            // Xóa cart sau khi đặt hàng thành công
            AddToCart::where('user_id', $user->id)->delete();
            
            return redirect()->route('orders.index')
                           ->with('success', 'Order placed successfully! Order number: ' . $order->order_number);
            
        } catch (\Exception $e) {
            \Log::error('Order placement error: ' . $e->getMessage());
            return redirect()->route('checkout')
                           ->with('error', 'Failed to place order. Please try again.');
        }
    }
}
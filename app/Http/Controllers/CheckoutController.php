<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddToCart;

class CheckoutController extends Controller
{

    public function index()
    {
        // Check user auth
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        // check phone & address not null
        $user = auth()->user();
        if (!$user->phone || !$user->address) {
            return redirect()->route('cart')->with('error', 'Please update your phone number and address in your profile to proceed with checkout.');
        }

        $cartItems = AddToCart::getCartItemsByUserId(auth()->id());
        if ($cartItems->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'Your cart is empty.');
        }

        $totalAmount = AddToCart::getTotalAmount(auth()->id());

        return view('checkout.checkout', compact('cartItems', 'totalAmount', 'user'));
    }

/*
     *** Xử lý đặt hàng
     */
    public function processOrder(Request $request)
    {
        // Validate payment method
        $request->validate([
            'payment_method' => 'required|in:COD,Banking'
        ]);

        $user = auth()->user();
        $cartItems = AddToCart::getCartItemsByUserId($user->id);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }
        
        // Get total amount
        $totalAmount = AddToCart::getTotalAmount($user->id);
        
        try {

            DB::transaction(function () use ($request, $user, $cartItems, $totalAmount) {

                $order = Order::createFromUser($user, $totalAmount, $request->payment_method);

                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product_name,
                        'unit_price' => $item->price,
                        'quantity' => $item->quantity,
                        'note' => $item->note,
                        'item_total' => $item->price * $item->quantity
                    ]);
                }
                
                // Clear cart after successful order
                AddToCart::where('user_id', $user->id)->delete();
            });

            return redirect()->route('orders')->with('success', 'Order placed successfully!');
            
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', 'Failed to place order. Please try again.');
        }
    }

}
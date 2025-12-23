<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'user_id', 
        'customer_name', 'customer_phone', 'customer_address',
        'total_amount', 'payment_method', 'status'
    ];

    /*
     *** Relationship với User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /*
     *** Relationship với OrderItems
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    /*
     *** Generate unique order number
     */
    public static function generateOrderNumber()
    {
        $prefix = 'ORD-' . date('Ym') . '-';
        $lastOrder = self::where('order_number', 'like', $prefix . '%')
                         ->orderBy('id', 'desc')
                         ->first();
        
        if ($lastOrder) {
            $lastNumber = intval(substr($lastOrder->order_number, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }
        
        return $prefix . $newNumber;
    }
    
    /*
     *** Create order from user và cart
     */
    public static function createFromCart($user, $cartItems, $paymentMethod)
    {
        // Tính total
        $totalAmount = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });
        
        // Tạo order
        $order = self::create([
            'order_number' => self::generateOrderNumber(),
            'user_id' => $user->id,
            'customer_name' => $user->name,
            'customer_phone' => $user->phone,
            'customer_address' => $user->address,
            'total_amount' => $totalAmount,
            'payment_method' => $paymentMethod,
            'status' => 'Pending'
        ]);
        
        // Tạo order items
        foreach ($cartItems as $cartItem) {
            $product = \App\Models\Product::where('product_id', $cartItem->product_id)->first();
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product_name,
                'unit_price' => $cartItem->price,
                'quantity' => $cartItem->quantity,
                'note' => $cartItem->note,
                'item_total' => $cartItem->price * $cartItem->quantity,
                'product_image' => $product ? $product->image : null // ✅ LƯU IMAGE SNAPSHOT
            ]);
        }
        
        return $order;
    }
}
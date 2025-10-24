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
     *** Relationship với Users table
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    /*
     *** Relationship với OrderItems table
     */
    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }
    
    /*
     *** Helper: Create order với snapshot từ user
     */
    public static function createFromUser($user, $totalAmount, $paymentMethod) {
        return self::create([
            'order_number' => self::generateOrderNumber(),
            'user_id' => $user->id,
            'customer_name' => $user->name,
            'customer_phone' => $user->phone,
            'customer_address' => $user->address,
            'total_amount' => $totalAmount,
            'payment_method' => $paymentMethod,
            'status' => 'Pending'
        ]);
    }
    
    /*
     *** Generate unique order number
     */
    public static function generateOrderNumber() {
        $prefix = 'ORD-' . date('Ym') . '-';
        $lastOrder = self::where('order_number', 'like', $prefix . '%')
                         ->orderBy('id', 'desc')
                         ->first();
        
        $number = $lastOrder ? 
            intval(substr($lastOrder->order_number, -3)) + 1 : 1;
        
        return $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
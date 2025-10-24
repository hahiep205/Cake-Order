<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'product_id', 'product_name', 
        'unit_price', 'quantity', 'note', 'item_total'
    ];

    /*
     *** Relationship với Orders table
     */
    public function order() {
        return $this->belongsTo(Order::class);
    }
}
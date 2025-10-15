<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AddToCart extends Model
{
    use HasFactory;

    protected $table = 'add_to_cart';

    protected $fillable = [
        'user_id',
        'product_id',
        'product_name',
        'price',
        'quantity',
        'note'
    ];

    /*
     *** Relationship: AddToCart thuộc về một User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /*
     *** Relationship: AddToCart thuộc về một Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    /*
     *** lấy tất cả items trong cart của user
     */
    public static function getCartItemsByUserId($userId)
    {
        return self::where('user_id', $userId)->get();
    }

    /*
     *** thêm sản phẩm vào cart
     */
    public static function addProductToCart($userId, $productId, $productName, $price, $quantity = 1, $note = null)
    {
        // Check xem sản phẩm đã có trong cart chưa
        $existingItem = self::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingItem) {
            // Nếu có rồi thì cộng thêm số lượng
            $existingItem->quantity += $quantity;
            $existingItem->save();
            return $existingItem;
        } else {
            // Nếu chưa có thì tạo mới - DÙNG DB::table
            $id = DB::table('add_to_cart')->insertGetId([
                'user_id' => (int) $userId,
                'product_id' => (string) $productId,
                'product_name' => (string) $productName,
                'price' => (float) $price,
                'quantity' => (int) $quantity,
                'note' => $note,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return self::find($id);
        }
    }

    /*
     *** tính tổng tiền
     */
    public static function getTotalAmount($userId)
    {
        return self::where('user_id', $userId)
            ->get()
            ->sum(function ($item) {
                return $item->price * $item->quantity;
            });
    }

    /*
     *** đếm số lượng items trong cart
     */
    public static function getCartItemsCount($userId)
    {
        return self::where('user_id', $userId)->count();
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddToCart;
use App\Models\Product;

class CartController extends Controller
{
    /*
     *** Hiển thị giỏ hàng
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to view cart.');
        }

        $userId = auth()->id();
        $cartItems = AddToCart::getCartItemsByUserId($userId);
        $totalAmount = AddToCart::getTotalAmount($userId);
        $itemsCount = AddToCart::getCartItemsCount($userId);

        return view('cart.cart', compact('cartItems', 'totalAmount', 'itemsCount'));
    }

    /*
     *** Thêm sản phẩm vào giỏ hàng
     */
    public function addToCart(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add products to cart.'
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|string|exists:products,product_id',
            'quantity' => 'integer|min:1',
        ]);

        try {
            $product = Product::where('product_id', $request->product_id)->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found.'
                ], 404);
            }

            // KIỂM TRA XEM SẢN PHẨM ĐÃ CÓ TRONG CART CHƯA
            $existingItem = AddToCart::where('user_id', auth()->id())
                ->where('product_id', $product->product_id)
                ->first();

            if ($existingItem) {
                // NẾU CÓ RỒI: Tăng số lượng
                $newQuantity = $existingItem->quantity + ($request->quantity ?? 1);

                // Check stock
                if ($product->stock < $newQuantity) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Not enough stock available. Only ' . $product->stock . ' items left.'
                    ], 400);
                }

                $existingItem->quantity = $newQuantity;
                $existingItem->save();

                $message = 'Product quantity updated in cart!';

            } else {
                // NẾU CHƯA CÓ: Tạo mới

                // Check stock
                if ($product->stock < ($request->quantity ?? 1)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Not enough stock available.'
                    ], 400);
                }

                \DB::table('add_to_cart')->insert([
                    'user_id' => auth()->id(),
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'price' => $product->price,
                    'quantity' => $request->quantity ?? 1,
                    'note' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                $message = 'Product added to cart successfully!';
            }

            $itemsCount = AddToCart::getCartItemsCount(auth()->id());

            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => $itemsCount
            ]);

        } catch (\Exception $e) {
            \Log::error('Add to cart error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to cart.'
            ], 500);
        }
    }

    /*
     *** Cập nhật số lượng sản phẩm trong giỏ
     */
    public function updateQuantity(Request $request, $id)
    {
        try {
            $cartItem = AddToCart::findOrFail($id);

            if ($cartItem->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action.'
                ], 403);
            }

            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            $product = Product::where('product_id', $cartItem->product_id)->first();
            if ($product->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough stock available.'
                ], 400);
            }

            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            $totalAmount = AddToCart::getTotalAmount(auth()->id());
            $itemTotal = $cartItem->price * $cartItem->quantity;

            return response()->json([
                'success' => true,
                'message' => 'Quantity updated successfully!',
                'item_total' => number_format($itemTotal, 2),
                'total_amount' => number_format($totalAmount, 2)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update quantity.'
            ], 500);
        }
    }

    /*
     *** Xóa sản phẩm khỏi giỏ hàng
     */
    public function removeItem($id)
    {
        try {
            $cartItem = AddToCart::findOrFail($id);

            if ($cartItem->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action.'
                ], 403);
            }

            $cartItem->delete();

            $totalAmount = AddToCart::getTotalAmount(auth()->id());
            $itemsCount = AddToCart::getCartItemsCount(auth()->id());

            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart successfully!',
                'total_amount' => number_format($totalAmount, 2),
                'items_count' => $itemsCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove product.'
            ], 500);
        }
    }

    /*
     *** Cập nhật ghi chú cho sản phẩm
     */
    public function updateNote(Request $request, $id)
    {
        try {
            $cartItem = AddToCart::findOrFail($id);

            if ($cartItem->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action.'
                ], 403);
            }

            $request->validate([
                'note' => 'nullable|string|max:500',
            ]);

            $cartItem->note = $request->note;
            $cartItem->save();

            return response()->json([
                'success' => true,
                'message' => 'Note updated successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update note.'
            ], 500);
        }
    }
}
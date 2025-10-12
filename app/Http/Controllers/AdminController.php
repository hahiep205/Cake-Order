<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    /*
     *** Func hiển thị trang admin với danh sách products
     */
    public function index()
    {
        // Check user
        if (auth()->user()->isUser()) {
            return redirect()->route('dashboard')->with('error', 'Access failed to admin page.');
        }

        // Lấy tất cả products và users từ database
        $products = Product::all();
        $users = User::all();

        return view('admin.admin', compact('products', 'users'));
    }

    /*
     *** Func xử lý update product
     */
    public function updateProduct(Request $request, $id)
    {
        try {
            // Validate input
            $request->validate([
                'product_id' => 'required|string|max:255',
                'product_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'image' => 'nullable|string|max:255',
            ]);

            // Tìm product cần update
            $product = Product::findOrFail($id);

            // Update thông tin
            $product->update([
                'product_id' => $request->product_id,
                'product_name' => $request->product_name,
                'price' => $request->price,
                'stock' => $request->stock,
                'description' => $request->description,
                'image' => $request->image,
            ]);

            return redirect()->route('admin')->with('success', 'Product updated successfully!');

        } catch (\Exception $e) {
            return redirect()->route('admin')->with('error', 'Failed to update product. Please try again.');
        }
    }

    /*
     *** Func xử lý delete product
     */
    public function deleteProduct($id)
    {
        try {
            // Tìm và xóa product
            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->route('admin')->with('success', 'Product deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->route('admin')->with('error', 'Failed to delete product. Please try again.');
        }
    }

    /*
     *** Func xử lý thêm product mới
     */
    public function storeProduct(Request $request)
    {
        try {
            // Validate input
            $request->validate([
                'product_id' => 'required|string|max:255|unique:products,product_id',
                'product_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'image' => 'nullable|string|max:255',
            ]);

            // Tạo product mới
            Product::create([
                'product_id' => $request->product_id,
                'product_name' => $request->product_name,
                'price' => $request->price,
                'stock' => $request->stock,
                'description' => $request->description,
                'image' => $request->image,
            ]);

            return redirect()->route('admin')->with('success', 'Product added successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin')->with('error', 'Please check your input. Product ID might already exist.');

        } catch (\Exception $e) {
            return redirect()->route('admin')->with('error', 'Failed to add product. Please try again.');
        }
    }
}
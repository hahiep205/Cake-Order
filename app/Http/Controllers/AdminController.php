<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        if (auth()->user()->isUser()) {
            return redirect()->route('dashboard')->with('error', 'Access failed to admin page.');
        }

        // Lấy data products và users từ dtb
        $products = Product::all();
        $users = User::all();

        return view('admin.admin', compact('products', 'users'));
    }

    public function updateProduct(Request $request, $id)
    {
        try {
            // Ktra input
            $request->validate([
                'product_id' => 'required|string|max:255',
                'product_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'image' => 'nullable|string|max:255',
            ]);

            $product = Product::findOrFail($id);

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

    public function deleteProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->route('admin')->with('success', 'Product deleted successfully!');
            
        } catch (\Exception $e) {
            return redirect()->route('admin')->with('error', 'Failed to delete product. Please try again.');
        }
    }

    /*
     *** thêm product mới
     */
    public function storeProduct(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|string|max:255|unique:products,product_id',
                'product_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'image' => 'nullable|string|max:255',
            ]);

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

    public function storeUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|email|max:50|unique:users,email',
                'phone' => 'nullable|numeric|digits:10',
                'address' => 'nullable|string',
                'role' => 'required|in:user,admin',
                'password' => 'required|string|min:6',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('admin', ['section' => 'users'])->with('success', 'User added successfully!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin', ['section' => 'users'])->with('error', 'Please check your input. Email might already exist.');
            
        } catch (\Exception $e) {
            return redirect()->route('admin', ['section' => 'users'])->with('error', 'Failed to add user. Please try again.');
        }
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|email|max:50|unique:users,email,' . $id,
                'phone' => 'nullable|numeric|digits:10',
                'address' => 'nullable|string',
                'role' => 'required|in:user,admin',
                'password' => 'nullable|string|min:6',
            ]);

            // Cbi data để update
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role,
            ];

            // Chỉ update password nếu có nhập
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            // Update thông tin
            $user->update($updateData);

            return redirect()->route('admin', ['section' => 'users'])->with('success', 'User updated successfully!');
            
        } catch (\Exception $e) {
            return redirect()->route('admin', ['section' => 'users'])->with('error', 'Failed to update user. Please try again.');
        }
    }

    public function deleteUser($id)
    {
        try {
            if (auth()->id() == $id) {
                return redirect()->route('admin', ['section' => 'users'])->with('error', 'You cannot delete your own account!');
            }

            // Tìm và xóa user
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin', ['section' => 'users'])->with('success', 'User deleted successfully!');
            
        } catch (\Exception $e) {
            return redirect()->route('admin', ['section' => 'users'])->with('error', 'Failed to delete user. Please try again.');
        }
    }

    /*
     *** Add product vào dashboard
     */
    public function addProductToMenu($id)
    {
        try {
            $product = Product::findOrFail($id);

            $product->increment('stock', 1);
            
            return redirect()->route('admin', ['section' => 'menu'])
                ->with('success', 'Product added to menu successfully!');
            
        } catch (\Exception $e) {
            return redirect()->route('admin', ['section' => 'menu'])
                ->with('error', 'Failed to add product to menu.');
        }
    }

    public function removeProductFromMenu($id)
    {
        try {
            $product = Product::findOrFail($id);
            
            $product->update(['stock' => 0]);
            
            return redirect()->route('admin', ['section' => 'menu'])
                ->with('success', 'Product removed from menu successfully!');
            
        } catch (\Exception $e) {
            return redirect()->route('admin', ['section' => 'menu'])
                ->with('error', 'Failed to remove product from menu.');
        }
    }

}
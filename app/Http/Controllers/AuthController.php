<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Product;

class AuthController extends Controller
{

    /*
     *** Func trả về page register.
     */
    public function register()
    {
        return view('register');
    }

    /*
     *** Func tạo account rồi tự động login, tạo session, redirect tới dashboard. 
     */
    public function registered(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        auth()->login($user);

        $sessionCode = $this->generateSessionCode();

        $user->update([
            'session_token' => $sessionCode
        ]);

        return redirect()->route('auth.register');
    }

    /*
     *** Func tạo session, dùng khi login.
     */
    private function generateSessionCode()
    {
        return Str::random(40);
    }

    /*
     *** Func check xem session có valid ko.
     */
    public function checkSession()
    {
        $sessionCode = session('custom_session_code');

        if (!$sessionCode) {
            return false;
        }

        return true;
    }


}
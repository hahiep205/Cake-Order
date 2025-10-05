@extends('layouts.app')

@section('title', 'CAKE - Đăng Ký')

@section('content')
<section style="min-height: 70vh; display: flex; align-items: center; justify-content: center; background: #f8f9fa; padding: 40px 20px;">
    <div style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); max-width: 450px; width: 100%;">
        <h1 style="text-align: center; margin-bottom: 30px; color: #333;">Register</h1>
        
        <form method="POST" action="{{ route('auth.registered') }}">
            @csrf
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Name</label>
                <input type="text" name="name" required 
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; outline: none;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Email</label>
                <input type="email" name="email" required 
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; outline: none;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Password</label>
                <input type="password" name="password" required 
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; outline: none;">
            </div>
            
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Confirm Password</label>
                <input type="password" name="password_confirmation" required 
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; outline: none;">
            </div>
            
            <button type="submit" class="btn-order" style="width: 100%; margin-bottom: 20px;">REGISTER</button>
            
            <p style="text-align: center; color: #666;">
                Already have an account? 
                <a href="{{ route('auth.login') }}" style="color: #ff6b9d; text-decoration: none; font-weight: 500;">Login here</a>
            </p>
        </form>
    </div>
</section>
@endsection
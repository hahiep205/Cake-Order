@extends('layouts.app')

@section('title', 'CAKE - Login')

@section('content')
<section id="log">
    <div class="log_container">
        <h2 class="section_title" style="font-size: 3rem; color: #222;">Login</h2>
        
        <form method="POST" action="{{ route('auth.logined') }}" class="log_form pacifico">
            @csrf
            
            <div class="form_group pacifico">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>
            
            <div class="form_group pacifico">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
            </div>
            
            <button type="submit" class="log_button pacifico">LOGIN</button>
            
            <p class="log_link_text">
                Don't have an account? 
                <a href="{{ route('auth.register') }}">Register here</a>
            </p>
        </form>
    </div>
</section>
@endsection
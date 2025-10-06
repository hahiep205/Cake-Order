@extends('layouts.app')

@section('title', 'CAKE - Register')

@section('content')
<section id="log">
    <div class="log_container">
        <h2 class="section_title" style="font-size: 3rem; color: #222;">Register</h2>
        
        <form method="POST" action="{{ route('auth.registered') }}" class="log_form pacifico">
            @csrf
            
            <div class="form_group pacifico">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter your full name">
            </div>
            
            <div class="form_group pacifico">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>
            
            <div class="form_group pacifico">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Create a password">
            </div>
            
            <div class="form_group pacifico">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">
            </div>
            
            <button type="submit" class="log_button pacifico">REGISTER</button>
            
            <p class="log_link_text">
                Already have an account? 
                <a href="{{ route('auth.login') }}">Login here</a>
            </p>
        </form>
    </div>
</section>
@endsection
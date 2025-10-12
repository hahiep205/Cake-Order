@extends('layouts.app')

@section('title', 'CAKES - Login')

@section('content')

    <section id="log" class="section_log">
        <div class="log_container">

            <h2 class="section_title">Login</h2>

            <form action="/login" method="POST" class="log_form">
                @csrf
                <div class="form_group">
                    <label for="email"><strong>Email</strong></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form_group">
                    <label for="password"><strong>Password</strong></label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="log_button">LOGIN</button>

                <p class="log_link_text">Don't have an account? <a href='/register'>Register here</a></p>
            </form>

        </div>
    </section>

    <script src="/js/header-scrolled.js"></script>

@endsection